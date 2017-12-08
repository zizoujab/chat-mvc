<?php

namespace Zizoujab\Controller;


use Zizoujab\Model\User;

class UserController extends Controller
{
    public function loginAction()
    {
        // if user is logged in no need to reenter credentials
//        $this->checkUserAuthenticatedAction();
        $result = [];
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->authenticateUser($username, $password)) {
                // redirect to home
                $this->redirect('/chat');
            } else {
                $result['error'] = 'Bad credentials';
            }
        }

        $this->renderView('login.html.php', $result);
    }

    public function registerAction()
    {

        $repo = $this->getRepository(User::class);
        $result = [];
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['re_password'])) {
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $rePassword = $_POST['re_password'];

            if ($password !== $rePassword) {
                $result['error'] = 'Passwords do not match';

            } else if ($user = $repo->findBy(['username' => $username], 1)) {
                $result['error'] = 'Oops username is already taken, try another one';

            } else if ($this->registerUser($username, $password)) {
                $result['success'] = 'Account Created!, <a href="/login">login</a> to start chatting';

            } else {
                $result['error'] = 'Something wrong happened';
            }
        }


        $this->renderView('register.html.php', $result);
    }

    public function logoutAction(){

        unset($_SESSION['user']);

        $this->redirect('/login');
    }


    public function usersAction(){
        $repo = $this->getRepository(User::class);
        $repo->updateLastSeen($this->getUser());
        $result = [];
        /** @var User[] $users */
        $users = $repo->findBy([], null, ['last_seen' => 'desc']);
        $currentUser = $this->getUser();
        foreach ($users as $user){
            if ($currentUser->getId() == $user->getId()){
                continue;
            }
            $result[] = [
                'username' => $user->getUsername(),
                'id' => $user->getId(),
                // user is active since last 5 seconds
                'active' => (time() - strtotime($user->getLastSeen())) < 5,
            ];
        }
        $this->returnJson($result);
    }

    public function checkUserAuthenticatedAction(){
        if (!$this->getUser()){
            $this->redirect('/login');
        }
    }

    private function authenticateUser($username, $password)
    {

        $repo = $this->getRepository(User::class);
        /** @var User $user */
        $user = $repo->findBy(['username' => $username], 1);
        if(!$user){
            return false;
        }
        if(password_verify($password, $user->getPassword())){
            $_SESSION['user'] = $user;
            return true;
        }

        return false;

    }

    private function registerUser($username, $password)
    {
        $repo = $this->getRepository(User::class);
        $user = $repo->hydrate(['username' => $username, 'password' => $password]);
        return $repo->saveUser($user);
    }


}
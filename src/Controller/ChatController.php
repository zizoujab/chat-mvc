<?php

namespace Zizoujab\Controller;


use Zizoujab\Model\Chat;
use Zizoujab\Model\User;

class ChatController extends Controller
{
    public function chatAction(){

        $this->renderView('chat.html.php');
    }

    public function getConversationAction(){
        $id = $_GET['id'];
        $lastId = $_GET['lastId'];

        $chatRepo = $this->getRepository(Chat::class);
        /** @var Chat[] $conversations */
        $conversations = $chatRepo->getConversations($this->getUser()->getId(), $id, $lastId);
        $result = [];
        foreach ($conversations as $conversation) {
            $result[] = ['id' => $conversation->getId(),
                'msg' => htmlspecialchars($conversation->getMsg()),
                'time' => $conversation->getCreatedAt(),
                'its_me' => $conversation->getSender()->getId() == $this->getUser()->getId()
            ];

        }
        $this->returnJson($result);
    }

    public function sendMessageAction()
    {
        $id = $_POST['id'];
        $msg = $_POST['msg'];
        if (!isset($id) || !isset($msg)){
            $this->returnJson(['success' => 'false']);
        }
        $chatRepo = $this->getRepository(Chat::class);
        $userRepo = $this->getRepository(User::class);
        $chat = new Chat();
        $chat->setSender($this->getUser());
        $chat->setReceiver($userRepo->find($id));
        $chat->setMsg($msg);
        $chatRepo->saveChat($chat);

        $this->returnJson(['success'=> 'true']);
    }

}
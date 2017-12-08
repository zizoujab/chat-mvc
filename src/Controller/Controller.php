<?php

namespace Zizoujab\Controller;


use Zizoujab\Model\User;

class Controller
{

    protected function renderView($viewName, $viewVars = array(), $includeHeader = true, $includeFooter = true)
    {
        $viewPath = __DIR__ . '/../View/' . $viewName;
        if (!file_exists($viewPath)) {
            throw new \InvalidArgumentException('Cannot find view withing View Folder');
        }

        if ($includeFooter) {
            require __DIR__ . '/../View/templates/header.html.php';
        }
        require $viewPath;

        if ($includeFooter) {
            require __DIR__ . '/../View/templates/footer.html.php';
        }
    }

    protected function returnJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    protected function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }


    /**
     * @return null|User
     */
    protected function getUser()
    {
        if (isset($_SESSION['user'])) {

            return $_SESSION['user'];
        }

        return null;
    }

    protected function getRepository($className)
    {
        $name = $className . 'Repository';
        if (class_exists($name)) {

            return new $name();
        }

        throw new \InvalidArgumentException('Repository not found ' . $className);
    }

    protected function getService($className)
    {
        $name = $className . 'Service';
        if (class_exists($name)) {

            return new $name();
        }

        throw new \InvalidArgumentException('Repository not found ' . $className);
    }

}
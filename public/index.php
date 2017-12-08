<?php

require_once __DIR__.'/../vendor/autoload.php';
session_start();

// route the request internally
$url = isset($_GET['url']) ? $_GET['url'] : parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($url != '/login' && $url != '/register'){
    $controller = new \Zizoujab\Controller\UserController();
    $controller->checkUserAuthenticatedAction();
}
if ('/login' === $url) {
    $controller = new \Zizoujab\Controller\UserController();
    $controller->loginAction();
} elseif ('/logout' == $url){
    $controller = new \Zizoujab\Controller\UserController();
    $controller->logoutAction();
} elseif ('/chat' === $url ) {
    $controller = new \Zizoujab\Controller\ChatController();
    $controller->chatAction();
} elseif ('/conversation_with' === $url  && isset($_GET['id'] )) {
    $controller = new \Zizoujab\Controller\ChatController();
    $controller->getConversationAction();
} elseif ('/send_message' === $url ) {
    $controller = new \Zizoujab\Controller\ChatController();
    $controller->sendMessageAction();
} elseif ('/register' === $url ) { // && isset($_GET['id']
    $controller = new \Zizoujab\Controller\UserController();
    $controller->registerAction();
} elseif ('/users' === $url ) { // && isset($_GET['id']
    $controller = new \Zizoujab\Controller\UserController();
    $controller->usersAction();
} else {
    die('notfound');
    header('HTTP/1.1 404 Not Found');
    echo '<html><body><h1>Page Not Found</h1></body></html>';
}



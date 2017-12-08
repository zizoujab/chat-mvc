## Installation

1. Clone the git repository or download it as a zip file , go to that folder,
open a terminal and execute 
```
    cd path/to/project/chat-mvc
    composer install
```

2. Execute the sql script to create database schema for you
```
       mysql -u root -p < chat.sql``
```

3. Update mysql connection params  in the the file ``chat-mvc/src/Model/Repository.php``
```
    $host = '127.0.0.1';
    $db = 'chat';
    $user = 'root';
    $pass = 'root';
```
## How to run it


The project can be run under apache with virtual host pointing to public folder as webroot directory
It is also possible to run it with the built in php server 
```
    cd path/to/project/chat-mvc/public
    php -S localhost:800
```

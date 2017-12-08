## Installation

1. Clone the git repository or download it as a zip file , go to that folder,
open a terminal and execute 
``composer install`` 
you have to be in chat folder in order for this command to work.

2. Execute the sql script to create database schema for you
``mysql -u root -p < chat.sql``

## How to run it


The project can be run under apache with virtual host pointing to public folder as webroot directory
It is also possible to run it with the built in php server 
``
cd path/to/project/chat/public
php -S localhost:800
``

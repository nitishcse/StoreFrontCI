StoreFrontCI
============
movie_store.sql is database.
import in your database.

DataBase Configuration: 
 - application/config/database.php

    $db['default']['hostname'] = 'localhost'; //Your Server

    $db['default']['username'] = 'root'; //User Name

    $db['default']['password'] = ''; //Password

    $db['default']['database'] = 'movie_store'; //Database Name

Config:
- application/config/config.php

    $config['base_url'] = 'http://localhost:1234/'; //Base Url  - put your base url. suppose your project is hosting in "www.domain.com/app" then put this "www.domain.com/app"



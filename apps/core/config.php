<?php
define("DB_NAME", $_ENV['DBDATABASE']);
define("DB_HOST", $_ENV['DBHOST']);
define("DB_USER", $_ENV['DBUSER']);
define("DB_PASS", $_ENV['DBPASSWORD']);
define("EMAIL_PSWD", $_ENV['EMAILPASSWORD']);
define("EMAIL_USER", 'opesam42@gmail.com');

if($_SERVER['SERVER_NAME'] == "127.0.0.1"){
    define("ROOT", "http://127.0.0.1/projects/portfolio-github/portfolio-oop/public/");    
}else{
    define("ROOT", "https://gbenga.koyeb.app/");   
}

define("DEBUG", true);
define("AUTHOR", 'Gbenga Opeyemi');
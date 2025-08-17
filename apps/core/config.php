<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../public');
$dotenv->load();

define("DB_NAME", $_ENV['DBDATABASE']);
define("DB_HOST", $_ENV['DBHOST']);
define("DB_USER", $_ENV['DBUSER']);
define("DB_PASS", $_ENV['DBPASSWORD']);

define("ADMIN_EMAIL_PSWD", $_ENV['ADMIN_EMAIL_PSWD']);
define("ADMIN_EMAIL", $_ENV['ADMIN_EMAIL']);
define("ADMIN_EMAIL_BACKUP1", $_ENV["ADMIN_EMAIL_BACKUP1"]);
define("ADMIN_EMAIL_BACKUP2", $_ENV["ADMIN_EMAIL_BACKUP2"]);

define("B2_ACCESS_KEY", $_ENV['B2_ACCESS_KEY']);
define("B2_SECRET_KEY", $_ENV['B2_SECRET_KEY']);
define("B2_BUCKET_NAME", $_ENV['B2_BUCKET_NAME']);
define("B2_REGION", $_ENV['B2_REGION']);
define("B2_BUCKET_ID", $_ENV['B2_BUCKET_ID']);
define("B2_ENDPOINT", $_ENV['B2_ENDPOINT']);

if($_SERVER['SERVER_NAME'] == "127.0.0.1"){
    define("ROOT", "http://127.0.0.1/projects/portfolio-github/portfolio-oop/public/");    
}else{
    define("ROOT", "https://gbenga.koyeb.app/");   
}

define("DEBUG", true);
define("AUTHOR", 'Gbenga Opeyemi');
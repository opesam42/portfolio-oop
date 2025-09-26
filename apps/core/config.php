<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$dotenvPath = __DIR__ . '/../../';
if (file_exists($dotenvPath . '.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($dotenvPath);
    $dotenv->load();
}

define("APP_ENV", $_ENV['APP_ENV'] ?? 'production');
define("DB_ENV", $_ENV['DB_ENV'] ?? 'production');

if (DB_ENV === 'development') {
    // Development
    define("DB_NAME",  'portfolio_db');
    define("DB_HOST", '127.0.0.1');
    define("DB_USER", 'root');
    define("DB_PASS", 'password');
    define("DB_PORT", '3306');
} else {
    // Production
    define("DB_NAME", $_ENV['DBDATABASE'] ?? '');
    define("DB_HOST", $_ENV['DBHOST'] ?? '');
    define("DB_USER", $_ENV['DBUSER'] ?? '');
    define("DB_PASS", $_ENV['DBPASSWORD'] ?? '');
    define("DB_PORT", $_ENV['DBPORT'] ?? '3306');
    
}

define("ADMIN_EMAIL_PSWD", $_ENV['ADMIN_EMAIL_PSWD'] ?? '');
define("ADMIN_EMAIL", $_ENV['ADMIN_EMAIL'] ?? '');
define("ADMIN_EMAIL_BACKUP1", $_ENV["ADMIN_EMAIL_BACKUP1"] ?? '');
define("ADMIN_EMAIL_BACKUP2", $_ENV["ADMIN_EMAIL_BACKUP2"] ?? '');

define("B2_ACCESS_KEY", $_ENV['B2_ACCESS_KEY'] ?? '');
define("B2_SECRET_KEY", $_ENV['B2_SECRET_KEY'] ?? '');
define("B2_BUCKET_NAME", $_ENV['B2_BUCKET_NAME'] ?? '');
define("B2_REGION", $_ENV['B2_REGION'] ?? '');
define("B2_BUCKET_ID", $_ENV['B2_BUCKET_ID'] ?? ''  );
define("B2_ENDPOINT", $_ENV['B2_ENDPOINT'] ?? '');
// define("B2_BASE_URL", B2_ENDPOINT . '/' . B2_BUCKET_NAME . '/');
define("B2_BASE_URL", "https://f003.backblazeb2.com/file/eaglespoint-website/");


if (APP_ENV === 'development') {
    define("ROOT", "http://localhost/portfolio-oop/public/");
    define("DEBUG", true);
} else {
    define("ROOT", "https://gbenga.koyeb.app/");
    define("DEBUG", false);
}

define("AUTHOR", 'Gbenga Opeyemi');


/* START META INFO CONSTANTS */

define("SITE_NAME", "Gbenga Opeyemi - Full-Stack Web Developer");
define("META_DESCRIPTION", "Gbenga Opeyemi is a FullStack Web Developer. Open to freelancing opportunities to improve user experience and help businesses achieve their goals.");
define("META_KEYWORDS", 
    "Web Developer, Backend Developer, Software Developer, Django Developer, PHP Developer, API Developer, Django Rest Framework, MySQL, PostgreSQL, Web Development, Freelance Developer, Portfolio, Gbenga Opeyemi, Opeyemi Oluwagbemiga, Lagos, Nigeria"
);

/* END META INFO CONSTANTS */
<?php
session_start();
require 'vendor/autoload.php';
if(file_exists('.env')){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
};


require "../apps/core/init.php";

$app = new App;
$app->loadController();

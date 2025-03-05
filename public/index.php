<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = new App();
$app->run();
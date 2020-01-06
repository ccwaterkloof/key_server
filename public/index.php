<?php

require __DIR__.'/../vendor/autoload.php';

$app = new App\Controller();
$app->handleKeyRequest($_GET);

<?php

header('Content-Type: text/html; charset=utf-8');

include __DIR__ . './../autoload.php';

use App\Application;
use Controller\Controller;

$app = new Application();
$mainController = new Controller();

$app->get('\/', function () use ($mainController) {
	return $mainController->index();
});
$app->get('\/route\/create?.+', function () use ($mainController) {
	return $mainController->createRoute();
});

$app->run(new \Layout\MainLayout());
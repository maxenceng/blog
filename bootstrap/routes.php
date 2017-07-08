<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\PrivateController;
use App\Controllers\PublicApiController;
use App\Controllers\PublicController;
use App\Controllers\SignupController;

/**
 * List of routes used for the app
 */
$app->get('/', HomeController::class . ':get')->setName('home');

$app->get('/public-posts', PublicController::class . ':getAll');
$app->get('/private-posts', PrivateController::class . ':getAll');
$app->get('/public-posts/{slug}', PublicController::class . ':getOne');
$app->get('/private-posts/{slug}', PrivateController::class . ':getOne');

/* TESTS */
$app->get('/db', HomeController::class . ':db');
$app->get('/pd', HomeController::class . ':pd');

$app->get('/login', LoginController::class . ':get');
$app->post('/login', LoginController::class . ':post');
$app->post('/signup', SignupController::class . ':post');
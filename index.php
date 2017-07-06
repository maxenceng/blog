<?php

require './vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\SignupController;
use \Slim\App;
use \Slim\Http\Request;
use \Slim\Http\Response;


$config = [
  'settings' => [
    'displayErrorDetails' => true,
    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'phpdev',
      'username' => 'root',
      'password' => 'root',
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
    ]
  ],
];

$app = new App($config);

/**
 * Launches the data from the Container file
 */
require('./app/Container.php');

/**
 * List of routes used for the app
 */


$app->get('/', HomeController::class . ':get')->setName('home');

/* TESTS */
$app->get('/db', HomeController::class . ':db');
$app->get('/pd', HomeController::class . ':pd');

$app->get('/signup', SignupController::class . ':get');
$app->post('/signup', SignupController::class . ':post');

$app->get('/login', LoginController::class . ':get');
$app->post('/login', LoginController::class . ':post');

$app->run();
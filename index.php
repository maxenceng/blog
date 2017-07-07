<?php

require './vendor/autoload.php';

use \Slim\App;

session_start();

$settings = require './bootstrap/settings.php';

$app = new App($settings);

require './bootstrap/container.php';
require './bootstrap/init.php';
require './bootstrap/routes.php';

$app->run();
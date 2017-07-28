<?php


$container = $app->getContainer();

/**
 * Function given by the Slim documentation to use Twig
 * @param $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function($container) {
  $dir = dirname(__DIR__);
  $view = new \Slim\Views\Twig($dir . '/app/Views', [
    'cache' => false
  ]);

  // Instantiate and add Slim specific extension
  $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
  $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
  $view->getEnvironment()->addGlobal('session', $_SESSION);

  return $view;
};

/**
 * Service factory for the ORM
 * @param $container
 * @return \Illuminate\Database\Capsule\Manager
 */
$container['db'] = function ($container) {
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  return $capsule;
};
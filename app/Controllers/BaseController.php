<?php

namespace App\Controllers;


use Slim\Http\Response;

class BaseController {

  protected $container;

  public function __construct($container) {
    $this->container = $container;
  }

  protected function render(Response $res, $template, $data = array()) {
    $this->container->view->render($res, $template, $data);
  }

  protected function redirect($url, $statusCode = null) {
    header('Location: ' . $url, true, $statusCode);
    die();
  }

  protected function sanitize($arg) {
    $step1 = strip_tags($arg);
    $step2 = htmlspecialchars($step1);
    return $step2;
  }

}
<?php

namespace App\Controllers;


class BaseController {

  protected $container;

  public function __construct($container) {
    $this->container = $container;
  }

  protected function redirect($url, $statusCode = null) {
    header('Location: ' . $url, true, $statusCode);
    die();
  }

}
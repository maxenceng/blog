<?php

namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class LoginController {

  private $container;

  public function __construct($container) {
    $this->container = $container;
  }

  public function get(Request $req, Response $res) {
    $this->container->view->render($res, 'login.twig');
  }

  public function post(Request $req, Response $res) {
    var_dump($_POST);
  }

}
<?php

namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class SignupController {

  private $container;

  public function __construct($container) {
    $this->container = $container;
  }

  public function get(Request $req, Response $res) {
    $this->container->view->render($res, 'signup.twig');
  }

  public function post(Request $req, Response $res) {
    var_dump($_POST);
  }
}
<?php

namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class LogoutController extends BaseController {

  public function get(Request $req, Response $res) {
    session_destroy();
    $this->redirect('/');
  }

}
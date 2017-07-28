<?php

namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class LogoutController extends BaseController {

  /**
   * @param Request $req
   * @param Response $res
   */
  public function get(Request $req, Response $res) {
    session_destroy();
    $this->redirect('/');
  }

}
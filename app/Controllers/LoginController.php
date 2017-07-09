<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController extends BaseController {


  public function get(Request $req, Response $res) {
    $this->container->view->render($res, 'login.twig');
  }

  public function post(Request $req, Response $res) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = User::all()->where('username', $username)->where('password', $password);
    if($user['username'] === null) {
      $this->redirect('/');
    }
    var_dump($username, $password);
  }

}
<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController extends BaseController {


  public function get(Request $req, Response $res) {
    $this->render($res, 'login.twig');
  }

  public function post(Request $req, Response $res) {
    $username = $this->sanitize($_POST['username']);
    $password = $this->sanitize($_POST['password']);
    $testOnUser = User::all()->where('username', $username)->where('password', $password)->count();
    if($testOnUser === 0) {
      $this->redirect('/login');
    }
    $_SESSION['username'] = $username;
    $this->redirect('/');
  }

}
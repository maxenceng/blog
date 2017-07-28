<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController extends BaseController {

  /**
   * @param Request $req
   * @param Response $res
   */
  public function get(Request $req, Response $res) {
    if (isset($_SESSION['username'])) {
      $this->redirect('/');
    } else {
      $this->render($res, 'login.twig');
    }
  }

  /**
   * Checks if the user exists and redirects depending on the condition
   * @param Request $req
   * @param Response $res
   */
  public function post(Request $req, Response $res) {
    $username = $this->sanitize($_POST['username']);
    $password = $this->sanitize($_POST['password']);
    $testOnUser = User::where('username', $username)->count();
    if($testOnUser === 0) {
      $this->redirect('/login');
    }

    $hashedPassword = User::where('username', $username)->first()->toArray()['password'];

    if(password_verify($password, $hashedPassword)) {
      $_SESSION['username'] = $username;
      $this->redirect('/');
    } else {
      $this->redirect('/login');
    }

  }

}
<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class SignupController extends BaseController {

  public function post(Request $req, Response $res) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    if($password !== $confirmPassword || $password === null) {
      $this->redirect('/');
    }
    $testOnUsername = User::all()->where('username', $username);
    $testOnEmail = User::all()->where('email', $email);
    if($testOnUsername['username'] !== null || $testOnEmail['username'] !== null) {
      $this->redirect('/');
    }
    // TODO: save the user

    var_dump($username, $email, $password, $confirmPassword);
  }
}
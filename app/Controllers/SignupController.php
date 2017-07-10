<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class SignupController extends BaseController {

  public function post(Request $req, Response $res) {
    $newUser = array(
      'username' => $this->sanitize($_POST['username']),
      'email' => $this->sanitize($_POST['email']),
      'password' => $this->sanitize($_POST['password'])
    );
    $confirmPassword = $this->sanitize($_POST['confirm-password']);
    if($newUser['password'] !== $confirmPassword || $newUser['password'] === null) {
      $this->redirect('/login');
    }
    $testOnUsername = User::all()->where('username', $newUser['username'])->count();
    $testOnEmail = User::all()->where('email', $newUser['email'])->count();
    if($testOnUsername === 1) {
      $this->redirect('/login');
    }
    if($testOnEmail === 1) {
      $this->redirect('/login');
    }

    $this->save($newUser);
    $_SESSION['username'] = $newUser['username'];
    $this->redirect('/');
  }

  private function save($newUser) {
    $user = new User();
    $user->username = $newUser['username'];
    $user->email = $newUser['email'];
    $user->password = $newUser['password'];
    $user->save();
  }
}
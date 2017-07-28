<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class SignupController extends BaseController {

  /**
   * Checks if the password and the password confirmation fields were equal,
   * checks if the user already exists,
   * checks if the email already exists,
   * save the user if the conditions are ok
   * @param Request $req
   * @param Response $res
   */
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
    $testOnUsername = User::where('username', $newUser['username'])->count();
    $testOnEmail = User::where('email', $newUser['email'])->count();
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

  /**
   * Saves the user in the DB
   * @param $newUser
   */
  private function save($newUser) {
    $user = new User();
    $user->username = $newUser['username'];
    $user->email = $newUser['email'];
    $user->password = password_hash($newUser['password'], PASSWORD_DEFAULT);
    $user->save();
  }
}
<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class PrivateController
{
  private $container;

  public function __construct($container) {
    $this->container = $container;
  }

  /**
   * Renders the private posts page
   * @param Request $req
   * @param Response $res
   */
  public function get(Request $req, Response $res) {
    $this->container->view->render($res, 'posts.twig', array(
      'state' => 'Private',
      'users' => User::all()
    ));
  }

}
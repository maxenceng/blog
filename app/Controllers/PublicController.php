<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class PublicController
{
  private $container;

  public function __construct($container) {
    $this->container = $container;
  }

  /**
   * Renders the public posts page
   * @param Request $req
   * @param Response $res
   */
  public function get(Request $req, Response $res) {
    $this->container->view->render($res, 'posts.twig', array(
      'state' => 'Public',
      'posts' => Post::all()->where('public', true)
    ));
  }

}
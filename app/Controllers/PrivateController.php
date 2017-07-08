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
  public function getAll(Request $req, Response $res) {
    $id = 3;
    $user = User::with('posts')->where('id', $id)->get(['id', 'username']);
    $this->container->view->render($res, 'private.twig', array(
      'user' => $user
    ));
  }

  public function getOne(Request $req, Response $res, $args) {
    /*
    $user = User::with('posts')->where('id', $id)->get(['id', 'username']);
    $post = Post::with(['user' => function($query) {
      $query->select('id', 'username');
    }])->where('slug', $args[slug])->where('public', false)->get();
    $this->container->view->render($res, 'private.twig', array(
      'state' => 'Slug',
      'posts' => $post
    ));
    */
  }


}
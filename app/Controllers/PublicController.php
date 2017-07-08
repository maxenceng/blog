<?php

namespace App\Controllers;


use App\Models\Post;
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
  public function getAll(Request $req, Response $res) {
    $posts = Post::with(['user' => function($query) {
      $query->select('id', 'username');
    }])->where('public', true)->get();
    $this->container->view->render($res, 'public.twig', array(
      'posts' => $posts
    ));
  }

  public function getOne(Request $req, Response $res, $args) {
    $post = Post::with(['user' => function($query) {
      $query->select('id', 'username');
    }])->where('slug', $args[slug])->where('public', true)->get();
    $this->container->view->render($res, 'public.twig', array(
      'posts' => $post
    ));
  }
}
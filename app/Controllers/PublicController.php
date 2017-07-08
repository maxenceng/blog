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
    $posts = Post::withUser()->get();
    $this->container->view->render($res, 'posts.twig', array(
      'state' => 'Public',
      'posts' => $posts
    ));
  }

  public function getOne(Request $req, Response $res, $args) {
    $posts = Post::withUser()->where('slug', $args[slug])->get();
    $this->container->view->render($res, 'post.twig', array(
      'post' => $posts[0]
    ));
  }
}
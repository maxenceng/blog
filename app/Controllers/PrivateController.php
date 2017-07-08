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
    $user = User::withPosts($id);
    $posts = $this->formatData($user);
    $this->container->view->render($res, 'posts.twig', array(
      'state' => 'Private',
      'posts' => $posts
    ));
  }

  public function getOne(Request $req, Response $res, $args) {
    $id = 3;
    $user = User::withSlug($id, $args[slug]);
    $posts = $this->formatData($user);
    $this->container->view->render($res, 'post.twig', array(
      'post' => $posts[0]
    ));
  }

  private function formatData($user) {
    $posts = $user[0][posts];
    foreach ($posts as $post) {
      $post[user] = new User();
      $post[user][username] = $user[0][username];
    }
    return $posts;
  }
}
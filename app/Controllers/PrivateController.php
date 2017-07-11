<?php

namespace App\Controllers;


use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class PrivateController extends BaseController {

  /**
   * Renders the private posts page
   * @param Request $req
   * @param Response $res
   */
  public function getAll(Request $req, Response $res) {
    $id = $this->getId();
    $user = User::withPosts($id);
    $posts = $this->formatData($user);
    $this->render($res, 'posts.twig', array(
      'state' => 'Private',
      'posts' => $posts
    ));
  }

  public function getOne(Request $req, Response $res, $args) {
    $id = $this->getId();
    $user = User::withSlug($id, $args['slug']);
    $posts = $this->formatData($user);
    $this->render($res, 'post.twig', array(
      'post' => $posts[0]
    ));
  }

  private function formatData($user) {
    $posts = $user[0]['posts'];
    foreach ($posts as $post) {
      $post['user'] = new User();
      $post['user']['username'] = $user[0]['username'];
    }
    return $posts;
  }

  private function getId() {
    return User::all()
      ->where('username', $_SESSION['username'])[0]
      ->get(['id'])
      ->toArray()[0]['id'];
  }
}
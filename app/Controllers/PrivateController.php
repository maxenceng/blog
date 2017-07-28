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
    if (!isset($_SESSION['username'])) {
      $this->redirect('/');
    } else {
      $id = $this->getId();
      $user = User::withPosts($id);
      $posts = $this->formatData($user);
      $this->render($res, 'posts.twig', array(
        'state' => 'Private',
        'posts' => $posts
      ));
    }
  }

  /**
   * Renders one post only
   * @param Request $req
   * @param Response $res
   * @param $args
   */
  public function getOne(Request $req, Response $res, $args) {
    if (!isset($_SESSION['username'])) {
      $this->redirect('/');
    } else {
      $id = $this->getId();
      $user = User::withSlug($id, $args['slug']);
      $posts = $this->formatData($user);
      $this->render($res, 'post.twig', array(
        'post' => $posts[0]
      ));
    }
  }

  /**
   * Modifies data to avoid having 2 more Twig views for private posts
   * @param $user
   * @return mixed
   */
  private function formatData($user) {
    $posts = $user[0]['posts'];
    foreach ($posts as $post) {
      $post['user'] = new User();
      $post['user']['username'] = $user[0]['username'];
    }
    return $posts;
  }

  /**
   * Gets the ID of the user
   * @return mixed
   */
  private function getId() {
    return User::where('username', $_SESSION['username'])->first()->toArray()['id'];
  }
}
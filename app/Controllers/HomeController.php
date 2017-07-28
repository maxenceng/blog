<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends BaseController {



    /**
     * Renders the home page
     * @param Request $req
     * @param Response $res
     */
    public function get(Request $req, Response $res) {
      $this->render($res, 'home.twig');
    }

  /**
   * Posts the article to the DB
   * @param Request $req
   * @param Response $res
   */
    public function post(Request $req, Response $res) {
      $title = $this->sanitize($_POST['title']);
      $newPost = array(
        'title' => $title,
        'slug' => $this->createSlug($title),
        'text' => $_POST['text'],
        'public' => $this->isPublic($_POST)
      );
      $this->save($newPost);
      $this->redirect('/');
    }

  /**
   * @param $newPost
   */
    private function save($newPost) {
      $post = new Post();
      $post->title = $newPost['title'];
      $post->slug = $newPost['slug'];
      $post->text = $newPost['text'];
      $post->public = $newPost['public'];
      $user = User::where('username', $_SESSION['username'])->first();
      $post->user()->associate($user);
      $post->save();
    }

  /**
   * Creates the slug to have correct routes
   * @param $title
   * @return mixed|string
   */
    private function createSlug($title) {
      $slug = strtolower($title);
      $slug = str_replace(' ', '-', $slug);
      return $slug;
    }

  /**
   * Checks if the article is public or not
   * @param $arg
   * @return bool
   */
    private function isPublic($arg) {
      if(!isset($arg['public'])) {
        return false;
      }
      return true;
    }
}
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

    private function save($newPost) {
      $post = new Post();
      $post->title = $newPost['title'];
      $post->slug = $newPost['slug'];
      $post->text = $newPost['text'];
      $post->public = $newPost['public'];
      $user = User::all()->where('username', $_SESSION['username'])[0];
      $post->user()->associate($user);
      $post->save();
    }

    private function createSlug($title) {
      $slug = strtolower($title);
      $slug = str_replace(' ', '-', $slug);
      return $slug;
    }

    private function isPublic($arg) {
      if(!isset($arg['public'])) {
        return false;
      }
      return true;
    }
}
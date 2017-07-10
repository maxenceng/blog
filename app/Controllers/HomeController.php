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
        'text' => $this->sanitize($_POST['text'])
      );
      $this->save($newPost);
    }

    public function db(Request $req, Response $res) {
      $b = true;
      $id = 3;
      $test5 = User::with('posts')->where('id', $id)->get(['id', 'username']);
      $test6 = Post::with(['user' => function($query) {
        $query->select('id', 'username');
      }])->where('public', true)->get();
      $test = User::all()->where('username', $_SESSION['username']);
      $test2 = User::find(1);
      var_dump($test[0]->toJson());
      var_dump($test2->toJson());
    }

    public function pd(Request $req, Response $res) {
      echo $this->container->pd->text('Hello _Parsedown_!');
    }

    private function save($newPost) {
      $post = new Post();
      $post->title = $newPost['title'];
      $post->slug = $newPost['slug'];
      $post->text = $newPost['text'];
      //$idUser = User::all()->where('username', $newPost['username'])->first()->get(['id'])->toArray()[0]['id'];
      $user = User::all()->where('username', $_SESSION['username'])[0];
      $test = User::find(1);
      $test->posts()->save($post);
    }

    private function createSlug($title) {
      $slug = strtolower($title);
      $slug = str_replace(' ', '-', $slug);
      return $slug;
    }
}
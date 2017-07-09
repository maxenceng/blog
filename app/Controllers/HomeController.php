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
      $this->container->view->render($res, 'home.twig');
    }

    public function db(Request $req, Response $res) {
      $b = true;
      $id = 3;
      $test5 = User::with('posts')->where('id', $id)->get(['id', 'username']);
      $test6 = Post::with(['user' => function($query) {
        $query->select('id', 'username');
      }])->where('public', true)->get();
      $test = User::withPosts($id);
      $test2 = User::withSlug($id, 'title-2');
      var_dump($test->toJson());
      var_dump($test2->toJson());
    }

    public function pd(Request $req, Response $res) {
      echo $this->container->pd->text('Hello _Parsedown_!');
    }
}
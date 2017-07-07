<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController {

    private $container;
    private $users;

    public function __construct($container) {
      $this->container = $container;
      $this->users = $container->db->table('users');
    }

    /**
     * Renders the home page
     * @param Request $req
     * @param Response $res
     */
    public function get(Request $req, Response $res) {
      $this->container->view->render($res, 'home.twig');
    }

    public function db(Request $req, Response $res) {
      $data = $this->users->get();
      $posts = Post::all()->toJson();
      $b = true;
      $test1 = User::find(2)->posts->where('public', $b)->toJson();
      $test2 = User::find(3)->posts->where('public', $b)->toJson();
      $test3 = Post::all()->where('public', $b)->toJson();
      $test4 = Post::find(1)->user->get(['username'])->toJson();
      var_dump($data);
      var_dump($posts);
      var_dump($test1);
      var_dump($test2);
      var_dump($test3);
      var_dump($test4);
    }

    public function pd(Request $req, Response $res) {
      echo $this->container->pd->text('Hello _Parsedown_!');
    }

}
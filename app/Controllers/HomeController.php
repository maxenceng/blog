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
      $b = true;
      $id = 3;
      $test5 = User::with('posts')->where('id', $id)->get(['id', 'username'])->toJson();
      $test6 = Post::with(['user' => function($query) {
        $query->select('id', 'username');
      }])->where('public', true)->get();
      var_dump($test5);
      var_dump($test6);
    }

    public function pd(Request $req, Response $res) {
      echo $this->container->pd->text('Hello _Parsedown_!');
    }

    public function slug(Request $req, Response $res, $args) {
      $post = Post::with(['user' => function($query) {
        $query->select('id', 'username');
      }])->where('slug', $args[slug])->where('public', true)->get();
      $this->container->view->render($res, 'public.twig', array(
        'state' => 'Slug',
        'posts' => $post
      ));

    }
}
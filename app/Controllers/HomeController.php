<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController {

    private $container;

    public function __construct($container) {
        $this->container = $container;
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
      $data = $this->container->db->table('posts')->get();
      var_dump($data);
    }

    public function pd(Request $req, Response $res) {
      echo $this->container->pd->text('Hello _Parsedown_!');
    }

}
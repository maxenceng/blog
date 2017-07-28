<?php

namespace App\Controllers;


use Slim\Http\Response;

class BaseController {

  protected $container;

  /**
   * BaseController constructor.
   * @param $container
   */
  public function __construct($container) {
    $this->container = $container;
  }

  /**
   * Uses Twig to render the view
   * @param Response $res
   * @param $template
   * @param array $data
   */
  protected function render(Response $res, $template, $data = array()) {
    $this->container->view->render($res, $template, $data);
  }

  /**
   * Redirects the user
   * @param $url
   * @param null $statusCode HTTP code
   */
  protected function redirect($url, $statusCode = null) {
    header('Location: ' . $url, true, $statusCode);
    die();
  }

  /**
   * Sanitizes the data posted
   * @param $arg
   * @return string
   */
  protected function sanitize($arg) {
    $step1 = strip_tags($arg);
    $step2 = htmlspecialchars($step1);
    return $step2;
  }

}
<?php
namespace app\controllers;
use app\core\Application;
use app\core\middlewares\BaseMiddleware;

/**
 *@var $authClass  app\core\middlewares\BaseMiddleware
 */
class Controller
{
  public $layout = 'main';
  public $action = '';
  public $middlewares = [];
  public function setLayout($layout)
  {
    $this->layout = $layout;
  }
  public function render($view, $params = [])
  {
    return Application::$app->view->renderView($view, $params);
  }
  public function registerMiddleware( BaseMiddleware $middlware)
  {
    $this->middlewares[] = $middlware;
  }
}

<?php
namespace app\core;

use app\core\exception\FileNotFoundException;

/**
 *
 */

class Router {
    public $request;
    public $response;
    protected $routes = [];
    public function __construct($request, $responce){
      $this->request = $request;
      $this->response = $responce;
    }
    public function get($path, $callback) : void {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback) : void {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve() : string {
      $path = $this->request->getPath();
      $method = $this->request->method();
      $callback = $this->routes[$method][$path] ?? false;
      if($callback === false){
        throw new FileNotFoundException();
      }
      if(\is_string($callback)){
        return Application::$app->view->renderView($callback);
      }
      if(\is_array($callback)){
        /** $var \app\core\Controller $controller */
        $controller = new $callback[0]();
        Application::$app->controller = $controller;
        $controller->action = $callback[1];
        $callback[0] = $controller;
        foreach($controller->middlewares as $middleware){
            $middleware->execute();
        }
        return \call_user_func($callback, $this->request, $this->response);

      }
    }
}

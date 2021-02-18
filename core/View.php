<?php
namespace app\core;

class View{
    public $title;
    public function renderView($view, $params = []) : string
    {
      
      $viewContent = $this->renderOnlyView($view, $params);
      $layoutContent = $this->layoutContent();
      return \str_replace('{{content}}', $viewContent, $layoutContent);
    }
    public function layoutContent() : string
    {
      $layout = Application::$app->controller->layout;
      \ob_start();
      require_once Application::$ROOT_DIR."/views/layouts/$layout.php";
      return \ob_get_clean();
    }
    protected function renderOnlyView($view, $params = []) : string{
      \ob_start();
      \extract($params);
      require_once Application::$ROOT_DIR."/views/$view.php";
      return \ob_get_clean();
    }
    public function renderContent($viewContent) : string
    {
      $layoutContent = $this->layoutContent();
      return \str_replace('{{content}}', $viewContent, $layoutContent);
    }
}
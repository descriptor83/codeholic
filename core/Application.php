<?php
namespace app\core;
use app\models\User;
 /**
  *
  */
 class Application
 {
   public static $ROOT_DIR;
   public $router;
   public $request;
   public $response;
   public $controller;
   public $db;
   public $session;
   public $user = null;
   public $userClass = 'User';
   public $view;
   public static $app;

   function __construct( string $rootPath, array $config)
   {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->view = new View();
        $this->db = new Database($config['db']);
        $primaryValue = $this->session->get('user');
        if($primaryValue){
          $primaryKey = $this->userClass::primaryKey();
          $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }
   }
   public function run() {
     try{
      echo  $this->router->resolve();
     } catch(\Exception $e){
       $this->response->setStatusCode($e->getCode());
       echo $this->view->renderView('error', ['exception' => $e]);
     }
   }
   public function getController()
   {
     return $this->controller;
   }
   public function setController($controller)
   {
     $this->controller = $controller;
   }
   public function login(User $user)
   {
     $this->user = $user;
     $primaryKey = $user::primaryKey();
     $primaryValue = $user->{$primaryKey};
     $this->session->set('user', $primaryValue);
   }
   public function logout()
   {
     $this->user = null;
     $this->session->remove('user');
   }
   public static function isGuest(){
     return !self::$app->user;
   }
 }
 

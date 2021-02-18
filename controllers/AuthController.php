<?php

namespace app\controllers;
use app\core\Request;
use app\models\User;
use app\core\Application;
use app\core\middlewares\AuthMiddleware;
use app\models\LoginForm;
use app\core\Response;
/**
 *
 */
class AuthController extends Controller
{
  public function __construct()
  {
    $this->registerMiddleware(new AuthMiddleware(['profile']));
  }
  public function login(Request $request, Response $response)
  {
    $loginForm = new LoginForm();
    if($request->isPost()){
        $loginForm->loadData($request->getBody());
        if($loginForm->validate() && $loginForm->login()){
            $response->redirect('/'); exit;
        }
    }
    return $this->render('login', ['model' => $loginForm]);
  }
  public function register(Request $request)
  {
    $registerModel = new User();
    if($request->isPost()){
      $registerModel->loadData($request->getBody());
      if($registerModel->validate() && $registerModel->save() ){
        Application::$app->session->setFlash('success', 'Thanks for registering');  
        Application::$app->response->redirect('/');
      }
     

    }
    return $this->render('register', ['model' => $registerModel]);
  }
  public function logout(Request $request, Response $response)
  {
    Application::$app->logout();
    $response->redirect('/'); exit;
  }
  public function profile()
  {
    return $this->render('profile');
  }

}

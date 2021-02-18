<?php
namespace app\models;

use app\core\Application;

class LoginForm extends Model
{
    public $email;
    public $password;
    public function rules() : array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }
    public function login() : bool {
        $user = User::findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email', null, [], 'User does not exist with this email');
            return false;
        }
        if(!password_verify($this->password, $user->password )){
            $this->addError('password', null, [], 'Password is incorrect');
            return false;
        }
        
        Application::$app->login($user);
        return true;
        
    }
    public function labels() : array
    {
        return ['email' => 'Email', 'password' => 'Password'];
    }
}

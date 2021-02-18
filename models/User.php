<?php

namespace app\models;

/**
 *
 */
class User extends DbModel
{
  public $firstname = '';
  public $lastname = '';
  public $password = '';
  public $email = '';
  public $confirmPassword = '';

  public function save() : bool
  {
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }
  public function rules(): array
  {
    return [
      'firstname' => [self::RULE_REQUIRED],
      'lastname' => [self::RULE_REQUIRED],
      'email' => [self::RULE_REQUIRED, self::RULE_EMAIL,
          [self::RULE_UNIQUE, 'class' => self::class ]],
      'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
      'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
    ];
  }
    public static function tableName(): string
    {
        return 'users';
    }
    public function attributes(): array
    {
        return ['firstname','lastname', 'email', 'password'];
    }
    public function labels(): array
    {
        return [
          'firstname' => 'First name',
          'lastname' => 'Last name',
          'email' => 'Email',
          'password' => 'Password',
          'confirmPassword' => 'Confirm password'
        ];
    }
    public static function primaryKey(): string
    {
      return 'id';
    }
    public static function findOne(array $vars)
    {
      $tableName = static::tableName();
      $attributes = array_keys($vars);
      $markedAttr = array_map(function($attr){ return "$attr = :$attr";}, $attributes);
      $stringAttr = implode('AND', $markedAttr);
      $sql = "SELECT * FROM $tableName WHERE $stringAttr";
      $statement = self::prepare($sql);
      foreach($vars as $key => $value){
          $statement->bindValue($key, $value);
      }
      $statement->execute();
      return $statement->fetchObject(static::class);
    }
    public function getDisplayName()
    {
      return $this->firstname;
    }
















}

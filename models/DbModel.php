<?php
namespace app\models;



use app\core\Application;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public function attributes(): array;
    abstract public static function primaryKey() : string;
    public function save() {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(function($attr){ return ":$attr"; }, $attributes);
        $sql = "INSERT INTO $tableName (".implode( ',', $attributes).") ";
        $sql .= "VALUES(".implode(',', $params).")";
        $statement = self::prepare($sql);
        foreach ($attributes as $attibute){
            $statement->bindValue(":$attibute", $this->{$attibute});
        }
        $statement->execute();
        return true;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }

}


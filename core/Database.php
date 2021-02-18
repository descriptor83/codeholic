<?php
namespace app\core;

class Database
{
    public $pdo;
    function __construct(array $config){
       $dsn = $config['dsn'] ?? '';
       $user = $config['user'] ?? '';
       $password = $config['password'] ?? '';
       $this->pdo = new \PDO($dsn, $user, $password);
       $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function applayMigrations(){
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigreations();
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        $newMigrations = [];
        foreach ($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME );
            $instance = new $className();
            $instance->up();
            $newMigrations[] = $migration;
            
        }
        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        } else {
            echo "All migrations are applied";
        }
        
    }
    public function createMigrationsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (";
        $sql .= "id INT AUTO_INCREMENT PRIMARY KEY,";
        $sql .= "migration VARCHAR(255),";
        $sql .= "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ";
        $sql .= "ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }
    public function getAppliedMigreations() {
       $statement = $this->pdo->prepare("SELECT migration FROM migrations");
       $statement->execute();
       return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
    public function saveMigrations( array $migrations){
        $migArray = array_map(function($m){ return "('$m')"; } , $migrations);
        $migString = implode(',', $migArray);
        $statement = "INSERT INTO migrations (migration) VALUES ".$migString;
        $this->pdo->exec($statement);
        
    }
    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }
}






















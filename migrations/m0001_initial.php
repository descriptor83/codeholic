<?php
class m0001_initial{
    function up() {
        $sql = "CREATE TABLE users (";
        $sql .= "id INT AUTO_INCREMENT PRIMARY KEY, ";
        $sql .= "email VARCHAR(255) NOT NULL, ";
        $sql .= "firstname VARCHAR(255) NOT NULL, ";
        $sql .= "lastname VARCHAR(255) NOT NULL, ";
        $sql .= "status TINYINT NOT NULL, ";
        $sql .= "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ";
        $sql .= "ENGINE=INNODB";
        $db = \app\core\Application::$app->db;
        $db->pdo->exec($sql);
    }
    function down() {
        echo 'Canceling migration';
    }
}

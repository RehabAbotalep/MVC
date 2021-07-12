<?php


use app\core\Application;

class m0002_password_column
{
    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password varchar(255) NOT NULL AFTER email");
    }

    public function down()
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE users DROP COLUMN password");
    }
}
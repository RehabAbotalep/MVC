<?php


namespace app\core;


class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applymigrations()
    {
        $this->createMigrationsTable();
        $appliedMigartions = $this->appliedMigartions();
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigartions);
        $newMigartions = [];
        
        foreach ($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }
            require_once Application::$ROOT_DIR . '/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied Migration $migration");
            $newMigartions[] = $migration;
        }
        if(!empty($newMigartions)){
            $this->saveMigartions($newMigartions);
        }else{
            $this->log("Nothing to migrate");
        }
    }

    private function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        )ENGINE=INNODB;  ");
    }

    private function appliedMigartions()
    {
        $statment = $this->pdo->prepare("SELECT migration FROM migrations");
        $statment->execute();
        return $statment->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function log(string $message)
    {
        echo '[ ' . date('Y-m-d') . '] ' .$message .PHP_EOL;
    }

    private function saveMigartions(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statment = $this->pdo->prepare("INSERT INTO migrations(migration) VALUES 
            $str
                                        
        ");
        $statment->execute();
    }
}
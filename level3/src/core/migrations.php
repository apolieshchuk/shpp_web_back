<?php

class Migrations {

    private $conn;

    public function __construct()
    {
        $this->conn = Model::connect();
    }

    public static function run () {
        $migrations = new Migrations();

        $needMigrations = $migrations->getMigrationFiles();

        if (!$needMigrations) return;

        foreach ($needMigrations as $file) {
            $migrations->migrate($file);
        }

    }

    private function getMigrationFiles () {
        $sqlFolder = SRC_PATH . 'migrations/';
        $allMigrations = glob($sqlFolder . '*.sql');

        // Check Migration table exists
        $stmt = $this->conn->query("SHOW TABLES LIKE 'Migrations'");
        if (!$stmt->rowCount()) {
            return $allMigrations;
        }

        // Compare migrations and return all that not up
        $stmt = $this->conn->query("SELECT migration FROM Migrations");
        $upMigrations = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return array_diff($allMigrations, $upMigrations);

    }

    private function migrate($file) {
        // up migration
        $command = MYSQL_SHELL_CONNECT . '<' . $file;
        shell_exec($command);

        // add migration into table versions
        $stmt = $this->conn->prepare("INSERT INTO Migrations(migration) VALUES (:fileName)");
        $stmt->execute([':fileName' => basename($file)]);
    }
}

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

        $needMigrations = array();
        foreach ($allMigrations as $file) {
            if (!in_array(basename($file), $upMigrations)) {
                array_push($needMigrations, $file);
            }
        }

        return $needMigrations;
    }

    private function migrate($file) {
        $sqlFile = file_get_contents($file);

        // up migration
        $this->conn->exec($sqlFile);

        // add migration into table versions
        $stmt = $this->conn->prepare("INSERT INTO Migrations(migration) VALUES (:fileName)");
        $stmt->execute([':fileName' => basename($file)]);
    }
}

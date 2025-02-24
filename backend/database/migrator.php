<?php

require_once __DIR__ . '/../configs/database.php';


try {
   $database = DatabaseConnection::getInstance();

   $migrations = glob(__DIR__ . "/migrations/*.sql");

   foreach ($migrations as $migration) {
      echo "Running migration: " . basename($migration) . "...\n";
      $sqlContent = file_get_contents($migration);
      $database->exec($sqlContent);
   }

   echo "All migrations were run.";
} catch (PDOException $pdoError) {
   echo "Error when running migrations" . $pdoError->getMessage() . "\n";
}

// echo json_encode($migrations);
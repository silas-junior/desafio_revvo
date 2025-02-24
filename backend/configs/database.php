<?php

class DatabaseConnection {
   private static $instance = null;
   private $pdo;
   
   private function __construct() {
      $host = '172.18.0.2';
      $dbName = 'challenge_revvo';
      $dbUser = 'root';
      $dbPass = 'root';

      try {
         $this->pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
         $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
            die(json_encode(['error' => $e->getMessage()]));
      }
   }

   public static function getInstance() {
      if (self::$instance === null) {
         self::$instance = new DatabaseConnection();
      }
      return self::$instance->pdo;
  }
}
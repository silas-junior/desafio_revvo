<?php
   $host = '172.18.0.2';
   $dbName = 'challenge_revvo';
   $dbUser = 'root';
   $dbPass = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Conexão bem-sucedida!\n";
} catch (PDOException $e) {
    echo "❌ Erro na conexão: " . $e->getMessage() . "\n";
}
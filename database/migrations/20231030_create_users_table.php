<?php
use Core\Database;

try {
    $db = Database::getInstance()->getConnection();
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) CHARACTER SET utf8mb4";
    $db->exec($sql);
    echo "Migration de usuários realizada com sucesso!";
} catch (Exception $e) {
    echo "Erro na migration: " . $e->getMessage();
}

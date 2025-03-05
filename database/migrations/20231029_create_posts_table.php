<?php
use Core\Database;

try {
    $db = Database::getInstance()->getConnection();
    $sql = "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) CHARACTER SET utf8mb4";
    $db->exec($sql);
    echo "Migration executada com sucesso!";
} catch (Exception $e) {
    echo "Falha na migration: " . $e->getMessage();
}

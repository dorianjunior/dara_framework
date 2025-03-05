<?php
namespace App\Models;

class User extends Model {
    protected $table = 'users';
    
    // Busca usuário pelo e-mail
    public function findByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}

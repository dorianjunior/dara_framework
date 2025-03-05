<?php
namespace App\Models;

use PDO;

class Model {
    protected $table;
    protected $primaryKey = 'id';
    protected $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }
    
    public function all() {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function find($id) {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function create(array $data) {
        $fields = implode(',', array_keys($data));
        $placeholders = ':' . implode(',:', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        return $this->connection->lastInsertId();
    }
    
    public function update($id, array $data) {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key,";
        }
        $set = rtrim($set, ',');
        $data['id'] = $id;
        $sql = "UPDATE {$this->table} SET $set WHERE {$this->primaryKey} = :id";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        return $stmt->execute(['id' => $id]);
    }
}

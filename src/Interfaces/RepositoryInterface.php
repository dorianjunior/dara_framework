<?php

namespace App\Interfaces;

/**
 * Interface para implementação do padrão Repository
 */
interface RepositoryInterface
{
    /**
     * Retorna todos os registros
     * 
     * @return array
     */
    public function all(): array;
    
    /**
     * Encontra um registro pelo ID
     * 
     * @param int $id
     * @return mixed
     */
    public function find(int $id);
    
    /**
     * Cria um novo registro
     * 
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
    
    /**
     * Atualiza um registro existente
     * 
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);
    
    /**
     * Remove um registro
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}

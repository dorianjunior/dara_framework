<?php

namespace App\Interfaces;

/**
 * Interface base para serviços da aplicação
 */
interface ServiceInterface
{
    /**
     * Executa a lógica principal do serviço
     * 
     * @param array $data
     * @return mixed
     */
    public function execute(array $data);
}

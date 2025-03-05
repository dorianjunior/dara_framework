<?php

namespace App\Services;

use App\Core\Session;
use App\Interfaces\ServiceInterface;

/**
 * Serviço de autenticação
 */
class AuthService implements ServiceInterface
{
    /**
     * Tenta autenticar um usuário
     * 
     * @param array $data
     * @return bool
     */
    public function execute(array $data)
    {
        // Validação básica
        if (empty($data['email']) || empty($data['password'])) {
            return false;
        }
        
        // Aqui você implementaria a lógica real de autenticação
        // com verificação no banco de dados e hash de senha
        
        // Exemplo simplificado para demonstração
        if ($this->verifyCredentials($data['email'], $data['password'])) {
            // Armazena o ID do usuário na sessão
            Session::set('user_id', 1); // ID de exemplo
            Session::regenerate(); // Regenera ID da sessão para segurança
            return true;
        }
        
        return false;
    }
    
    /**
     * Verifica as credenciais do usuário
     * 
     * @param string $email
     * @param string $password
     * @return bool
     */
    private function verifyCredentials(string $email, string $password): bool
    {
        // Implementação real verificaria no banco de dados
        // Exemplo simplificado
        return ($email === 'admin@exemplo.com' && $password === 'senha123');
    }
}

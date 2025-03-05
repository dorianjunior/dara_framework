<?php

namespace App\Core;

/**
 * Classe Session
 * 
 * Esta classe gerencia sessões PHP, fornecendo métodos para iniciar, 
 * armazenar, recuperar e destruir dados de sessão de forma segura.
 */
class Session {
    
    /**
     * Inicia a sessão se ainda não estiver ativa.
     * 
     * Configura a sessão com opções de segurança recomendadas, como
     * tempo de vida do cookie, segurança para HTTPS, e proteções httponly.
     */
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            // Opções de configuração recomendadas
            session_start([
                'cookie_lifetime' => 3600,
                'cookie_secure'   => isset($_SERVER['HTTPS']),
                'cookie_httponly' => true,
                'use_strict_mode' => true,
            ]);
        }
    }
    
    /**
     * Armazena um valor na sessão.
     * 
     * @param string $key A chave para armazenar o valor na sessão.
     * @param mixed $value O valor a ser armazenado.
     * @return void
     */
    public static function set(string $key, $value): void {
        self::start();
        $_SESSION[$key] = $value;
    }
    
    /**
     * Recupera um valor da sessão.
     * 
     * @param string $key A chave do valor a ser recuperado.
     * @param mixed $default Valor padrão a ser retornado caso a chave não exista.
     * @return mixed O valor armazenado na sessão ou o valor padrão.
     */
    public static function get(string $key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }
    
    /**
     * Remove um valor específico da sessão.
     * 
     * @param string $key A chave do valor a ser removido.
     * @return void
     */
    public static function remove(string $key): void {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    
    /**
     * Destrói completamente a sessão atual.
     * 
     * Remove todos os dados da sessão e destrói a sessão.
     * 
     * @return void
     */
    public static function destroy(): void {
        self::start();
        session_unset();
        session_destroy();
    }
    
    /**
     * Regenera o ID da sessão.
     * 
     * Útil para prevenir ataques de fixação de sessão.
     * Recomendado ser usado após login do usuário.
     * 
     * @return void
     */
    public static function regenerate(): void {
        self::start();
        session_regenerate_id(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Response;

/**
 * Controlador base com métodos comuns
 */
abstract class BaseController
{
    /**
     * Renderiza uma view com dados
     * 
     * @param string $view
     * @param array $data
     * @return mixed
     */
    protected function view(string $view, array $data = [])
    {
        // Implementação de renderização de view
        extract($data);
        ob_start();
        include __DIR__ . '/../../../views/' . $view . '.php';
        $content = ob_get_clean();
        return $content;
    }
    
/**
     * Envia uma resposta JSON.
     *
     * @param mixed $data Os dados a serem enviados na resposta.
     * @param int $statusCode O código de status HTTP (padrão é 200).
     * @return string A resposta em formato JSON.
     */
    public static function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        
        return json_encode([
            'status' => $statusCode >= 200 && $statusCode < 300 ? 'success' : 'error',
            'data' => $data,
            'timestamp' => date('c')
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

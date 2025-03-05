<?php

namespace App\Http\Middleware;

use App\Http\Request;

/**
 * Middleware para gerenciar Cross-Origin Resource Sharing (CORS)
 */
class CorsMiddleware
{
    /**
     * Configura os cabeçalhos CORS
     * 
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle(Request $request, callable $next)
    {
        // Define os cabeçalhos CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        
        // Se for uma requisição OPTIONS, retorna 200 OK
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header('HTTP/1.1 200 OK');
            exit;
        }
        
        return $next($request);
    }
}

<?php

namespace App\Core;

use Closure;

/**
 * Classe Route
 * 
 * Esta classe gerencia a definição de rotas para diferentes métodos HTTP.
 */
class Route
{
    protected static $routes = [];

    protected static $groupMiddleware = [];

    /**
     * Método auxiliar para adicionar uma rota e aplicar middleware se necessário
     *
     * @param string $method Método HTTP
     * @param string $uri URI da rota
     * @param mixed $action Ação a ser executada
     * @return void
     */
    public static function add(string $method, string $path, array|Closure $action, array $middlewares = []): void
    {
        if (!empty(self::$groupMiddleware)) {
            $middlewares = array_merge(self::$groupMiddleware, $middlewares);
        }

        self::$routes[] = [
            'method' => strtoupper($method),
            'path' => self::formatPath($path),
            'action' => $action,
            'middlewares' => $middlewares,
        ];
    }

    /**
     * Formata um caminho de URL para garantir consistência.
     *
     * Remove barras (/) iniciais e finais para padronizar
     * todos os caminhos no sistema de roteamento.
     *
     * @param string $path Caminho a ser formatado.
     * @return string Caminho formatado.
     */
    private static function formatPath(string $path): string
    {
        return trim($path, '/');
    }

    /**
     * Registra uma rota para o método HTTP GET.
     * 
     * Usado para rotas que recuperam recursos ou páginas.
     *
     * @param string $path Caminho da URL.
     * @param array|Closure $action Controlador e método ou função anônima.
     * @param array $middlewares Middlewares para esta rota.
     * @return void
     */
    public static function get(string $path, array|Closure $action, array $middlewares = []): void
    {
        self::add('GET', $path, $action, $middlewares);
    }
    
    /**
     * Registra uma rota para o método HTTP POST.
     * 
     * Usado para rotas que criam novos recursos.
     *
     * @param string $path Caminho da URL.
     * @param array|Closure $action Controlador e método ou função anônima.
     * @param array $middlewares Middlewares para esta rota.
     * @return void
     */
    public static function post(string $path, array|Closure $action, array $middlewares = []): void
    {
        self::add('POST', $path, $action, $middlewares);
    }
    
    /**
     * Registra uma rota para o método HTTP PUT.
     * 
     * Usado para rotas que atualizam recursos existentes completos.
     *
     * @param string $path Caminho da URL.
     * @param array|Closure $action Controlador e método ou função anônima.
     * @param array $middlewares Middlewares para esta rota.
     * @return void
     */
    public static function put(string $path, array|Closure $action, array $middlewares = []): void
    {
        self::add('PUT', $path, $action, $middlewares);
    }
    
    /**
     * Registra uma rota para o método HTTP PATCH.
     * 
     * Usado para rotas que atualizam parcialmente recursos existentes.
     *
     * @param string $path Caminho da URL.
     * @param array|Closure $action Controlador e método ou função anônima.
     * @param array $middlewares Middlewares para esta rota.
     * @return void
     */
    public static function patch(string $path, array|Closure $action, array $middlewares = []): void
    {
        self::add('PATCH', $path, $action, $middlewares);
    }
    
    /**
     * Registra uma rota para o método HTTP DELETE.
     * 
     * Usado para rotas que removem recursos.
     *
     * @param string $path Caminho da URL.
     * @param array|Closure $action Controlador e método ou função anônima.
     * @param array $middlewares Middlewares para esta rota.
     * @return void
     */
    public static function delete(string $path, array|Closure $action, array $middlewares = []): void
    {
        self::add('DELETE', $path, $action, $middlewares);
    }
    
    /**
     * Registra uma rota para o método HTTP OPTIONS.
     * 
     * Usado para descobrir quais métodos HTTP são suportados em uma URL.
     *
     * @param string $path Caminho da URL.
     * @param array|Closure $action Controlador e método ou função anônima.
     * @param array $middlewares Middlewares para esta rota.
     * @return void
     */
    public static function options(string $path, array|Closure $action, array $middlewares = []): void
    {
        self::add('OPTIONS', $path, $action, $middlewares);
    }
    
    /**
     * Registra uma rota para o método HTTP HEAD.
     * 
     * Similar ao GET, mas retorna apenas os cabeçalhos, sem o corpo da resposta.
     *
     * @param string $path Caminho da URL.
     * @param array|Closure $action Controlador e método ou função anônima.
     * @param array $middlewares Middlewares para esta rota.
     * @return void
     */
    public static function head(string $path, array|Closure $action, array $middlewares = []): void
    {
        self::add('HEAD', $path, $action, $middlewares);
    }

    /**
     * Retorna todas as rotas registradas na aplicação.
     * 
     * Utilizado pelo Router para realizar o dispatch das requisições.
     * 
     * @return array Conjunto de todas as rotas registradas.
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * Inicia a configuração de middleware para um grupo de rotas.
     * 
     * @param string|array $middleware
     * @return Middleware
     */
    public static function middleware(string|array $middleware): Middleware
    {
        self::$groupMiddleware = (array) $middleware;
        return new Middleware();
    }

    public static function resetGroupMiddleware(): void
    {
        self::$groupMiddleware = [];
    }
}


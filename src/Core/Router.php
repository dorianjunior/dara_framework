<?php

namespace App\Core;

use App\Http\Request;

/**
 * Classe Router
 * 
 * Esta classe é responsável por executar o roteamento da aplicação,
 * combinando as requisições às rotas definidas e aplicando os middlewares.
 */
class Router
{
    /**
     * Executa o roteador, processando a requisição atual.
     * 
     * Identifica a rota correspondente à URI atual, aplica os middlewares
     * e executa a ação associada à rota.
     * 
     * @return void
     */
    public function dispatch()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        
        $routes = Route::getRoutes();

        $matchedRoute = self::matchRouteWithParams($method, $uri, $routes);

        if ($matchedRoute) {
            $action = $matchedRoute['action'];
            $params = $matchedRoute['params'];
            $middlewares = $matchedRoute['middlewares'];

            $request = new Request($params);

            if (!empty($middlewares)) {
                foreach ($middlewares as $middleware) {
                    $middlewareInstance = new $middleware();
                    $middlewareInstance->handle($request);
                }
            }

            [$controller, $method] = $action;
            $controllerInstance = new $controller();
            
            $id = $params['id'] ?? null;
            
            echo call_user_func([$controllerInstance, $method], $id, $request);
        } else {
            http_response_code(404);
            echo "Rota não encontrada";
        }
    }

    /**
     * Encontra uma rota correspondente à URI e método, extraindo parâmetros.
     * 
     * @param string $method Método HTTP da requisição
     * @param string $uri URI da requisição
     * @param array $routes Lista de rotas para verificar
     * @return array|null Dados da rota encontrada ou null se não encontrar
     */
    private static function matchRouteWithParams($method, $uri, $routes)
    {
        if (isset($routes[$method][$uri])) {
            return [
                'action' => $routes[$method][$uri],
                'params' => [],
                'routePattern' => $uri
            ];
        }

        foreach ($routes[$method] ?? [] as $routePattern => $action) {
            $pattern = preg_replace('/\{([^}]+)\}/', '(?P<$1>[^/]+)', $routePattern);
            $pattern = str_replace('/', '\/', $pattern);

            if (preg_match("/^{$pattern}$/", $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return [
                    'action' => $action,
                    'params' => $params,
                    'routePattern' => $routePattern
                ];
            }
        }

        return null;
    }
}
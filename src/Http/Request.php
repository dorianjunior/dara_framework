<?php

namespace App\Http;

use App\Traits\Paginator;
use App\Traits\Sanitize;
use App\Traits\Validator;

/**
 * Classe Request
 * 
 * Esta classe representa uma requisição HTTP e fornece métodos para acessar
 * dados da requisição, como parâmetros de consulta, dados de formulário e cabeçalhos.
 */
class Request {

    use Paginator, Sanitize, Validator;

    protected $data;
    protected $routeParams;
    protected $queryParams;
    protected $request;
    protected $server;
    protected $headers;
    protected $cookies;
    protected $files;

    public function __construct($routeParams = []) {
        $this->data = $this->parseRequestData();
        $this->routeParams = $routeParams;
        $this->queryParams = $_GET;
        $this->request = $_POST;
        $this->server = $_SERVER;
        $this->headers = getallheaders();
        $this->cookies = $_COOKIE;
        $this->request = $_FILES;
    }


    /**
     * Obtem os dados da requisição.
     * 
     * @return array Um array associativo de todos os dados da requisição.
     */
    protected function parseRequestData()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (strpos($contentType, 'application/json') !== false) {
            return json_decode(file_get_contents('php://input'), true) ?? [];
        } elseif (strpos($contentType, 'multipart/form-data') !== false) {
            return $_POST;
        } else {
            return array_merge($_GET, $_POST);
        }
    }
    
    /**
     * Obtém todos os dados da requisição.
     * 
     * @return array Um array associativo de todos os dados da requisição.
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Obtém um dado enviado via GET, POST ou JSON.
     * 
     * @param string $key A chave do dado que deseja obter.
     * @param mixed $default Valor padrão a ser retornado caso o dado não exista.
     * @return mixed O valor do dado ou o valor padrão.
     */
    public function input($key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    /**
     * Obtém um dado enviado via GET.
     * 
     * @param string $key A chave do dado que deseja obter.
     * @param mixed $default Valor padrão a ser retornado caso o dado não exista.
     * @return mixed O valor do dado ou o valor padrão.
     */
    public function get($key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * Obtém um dado enviado via POST.
     * 
     * @param string $key A chave do dado que deseja obter.
     * @param mixed $default Valor padrão a ser retornado caso o dado não exista.
     * @return mixed O valor do dado ou o valor padrão.
     */
    public function post($key, $default = null)
    {
        return $this->request[$key] ?? $default;
    }

    /**
     * Verifica se os dados da requisição contêm a chave especificada.
     *
     * Este método determina se os dados da requisição (ex: GET, POST, JSON) contêm a chave especificada.
     *
     * @param string $key A chave a ser verificada nos dados da requisição.
     * @return bool Verdadeiro se a chave existir nos dados da requisição, falso caso contrário.
     */
    public function has($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Obtém o método HTTP da requisição.
     * 
     * @return string O método HTTP da requisição.
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Obtém a URI da requisição.
     * 
     * @return array|bool|int|string|null
     */
    public function uri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return rtrim($uri, '/');
    }

    /**
     * Obtém um cabeçalho da requisição.
     * 
     * @param string $name O nome do cabeçalho que deseja obter.
     * @return string|null O valor do cabeçalho ou null se não existir.
     */
    public function headers($key, $default = null)
    {
        return $this->headers[ucwords(strtolower($key), '-')] ?? $default;
    }

    /**
     * Obtém o token de autenticação Bearer da requisição.
     * 
     * @return string|null O token de autenticação Bearer ou null se não existir.
     */
    public function bearerToken()
    {
        $authorization = $this->headers('Authorization');
        if ($authorization && preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Valida os dados da requisição com base em um conjunto de regras.
     * 
     * @param array $rules Um array associativo de regras de validação, onde as chaves são os nomes dos campos e os valores são as regras de validação.
     * @return array Um array associativo de mensagens de erro, onde as chaves são os nomes dos campos e os valores são arrays de mensagens de erro.
     */
    public function validate(array $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $value = $this->input($field);
            
            if (strpos($rule, 'required') !== false && empty($value)) {
                $errors[$field][] = "$field é obrigatório";
            }

            if (strpos($rule, 'email') !== false && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field][] = "$field deve ser um e-mail válido";
            }

            if (strpos($rule, 'numeric') !== false && !is_numeric($value)) {
                $errors[$field][] = "$field deve ser numérico";
            }
        }

        return $errors;
    }


    /**
     * Obtém um parâmetro da URL.
     * 
     * @param string $key A chave do parâmetro que deseja obter.
     * @param mixed $default Valor padrão a ser retornado caso o parâmetro não exista.
     * @return mixed O valor do parâmetro ou o valor padrão.
     */
    public function query($key = null, $default = null)
    {
        if ($key === null) {
            return array_filter($this->queryParams, function($value, $k) {
                return !in_array($k, ['page', 'limit', 'order']);
            }, ARRAY_FILTER_USE_BOTH);
        }

        return $this->queryParams[$key] ?? $default;
    }

    /**
     * Obtém um parâmetro da URL.
     * 
     * @param string $key A chave do parâmetro que deseja obter.
     * @param mixed $default Valor padrão a ser retornado caso o parâmetro não exista.
     * @return mixed O valor do parâmetro ou o valor padrão.
     */
    public function route($key = null, $default = null)
    {
        if ($key === null) {
            return $this->routeParams;
        }
        return $this->routeParams[$key] ?? $default;
    }
}


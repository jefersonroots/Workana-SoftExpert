<?php

// Classe para definir rotas
class Route
{
    private static $routes = [];

    public static function get($uri, $callback)
    {
        self::$routes[] = ['GET', $uri, $callback];
    }

    public static function post($uri, $callback)
    {
        self::$routes[] = ['POST', $uri, $callback];
    }

    public static function match($methods, $uri, $callback)
    {
        $methods = is_array($methods) ? $methods : [$methods];
        foreach ($methods as $method) {
            self::$routes[] = [strtoupper($method), $uri, $callback];
        }
    }

    public static function dispatch($method, $uri)
    {
        foreach (self::$routes as $route) {
            list($routeMethod, $routeUri, $callback) = $route;
            if ($routeMethod === $method && self::matchUri($routeUri, $uri)) {
                self::callCallback($callback);
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }

    private static function matchUri($routeUri, $requestUri)
    {
        $routeParts = explode('/', $routeUri);
        $requestParts = explode('/', $requestUri);

        if (count($routeParts) !== count($requestParts)) {
            return false;
        }

        $params = [];
        for ($i = 0; $i < count($routeParts); $i++) {
            if ($routeParts[$i] !== $requestParts[$i]) {
                if (strpos($routeParts[$i], '{') !== false && strpos($routeParts[$i], '}') !== false) {
                    $params[] = $requestParts[$i];
                } else {
                    return false;
                }
            }
        }

        if (!empty($params)) {
            $keys = [];
            $values = [];
            foreach ($params as $param) {
                $param = trim($param, '{}');
                $keys[] = '/{' . $param . '}/';
                $values[] = $param;
            }
            $routeUri = preg_replace($keys, $values, $routeUri);
        }

        return $routeUri === $requestUri;
    }

    private static function callCallback($callback)
    {
        if (is_callable($callback)) {
            call_user_func($callback);
        } elseif (is_string($callback)) {
            $parts = explode('@', $callback);
            $className = $parts[0];
            $methodName = $parts[1];
            $instance = new $className();
            call_user_func([$instance, $methodName]);
        }
    }
}

// Definição das rotas
Route::get('/produtos', 'ProdutoController@index');
Route::post('/produtos', 'ProdutoController@store');
Route::get('/produtos/{id}', 'ProdutoController@show');
Route::put('/produtos/{id}', 'ProdutoController@update');
Route::delete('/produtos/{id}', 'ProdutoController@destroy');

// Classe controladora de produtos
class ProdutoController
{
    public function index()
    {
        echo 'Listar todos os produtos';
    }

    public function store()
    {
        echo 'Cadastrar um produto';
    }

    public function show($id)
    {
        echo 'Buscar produto: ' . $id;
    }

    public function update($id)
    {
        echo 'Atualizar produto: ' . $id;
    }

    public function destroy($id)
    {
        echo 'Excluir produto: ' . $id;
    }
}

// Disparar a rota correspondente
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['PATH_INFO'] ?? '';

Route::dispatch($method, $uri);

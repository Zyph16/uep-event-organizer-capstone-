<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Controller;
class Router extends Controller
{
    private array $routes = [];

    public function add(string $method, string $path, callable $handler, array $middlewares = []): void
    {
        $this->routes[] = compact('method', 'path', 'handler', 'middlewares');
    }

    public function dispatch(string $method, string $path)
    {
        foreach ($this->routes as $route) {
            if (strtoupper($method) !== strtoupper($route['method'])) continue;
            if ($route['path'] !== $path) continue;

            $handler = $route['handler'];
            $requestBody = $this->requestJson() ?? [];

            // run middlewares
            $params = [];
            foreach ($route['middlewares'] as $mw) {
                $result = $mw($params);
                if ($result === false) {
                    return; // middleware already handled response
                }
                if (is_array($result)) {
                    $params = array_merge($params, $result);
                }
            }

            return call_user_func($handler, $requestBody, $params);
        }

        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }
}

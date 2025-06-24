<?php
class Router {
    private $routes = [];

    public function add(string $path, string $file): void
    {
        $path = rtrim($path, '/');
        if ($path === '') {
            $path = '/';
        }
        $this->routes[$path] = $file;
    }

    public function dispatch(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        if ($uri === '') {
            $uri = '/';
        }

        if (isset($this->routes[$uri])) {
            $file = dirname(__DIR__) . '/' . ltrim($this->routes[$uri], '/');
            if (file_exists($file)) {
                require $file;
                return;
            }
        }

        http_response_code(404);
        echo 'Page not found';
    }
}

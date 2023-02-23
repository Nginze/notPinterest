<?php

class Router
{
    private $handlers;
    public function get($path, $handler)
    {
        $this->addHandler($path, $handler, "GET");
    }

    public function post($path, $handler)
    {
        $this->addHandler($path,  $handler, "POST");
    }

    public function addHandler($path, $handler, $method)
    {
        $this->handlers[$path . $method] = [
            "path" => $path,
            "method" => $method,
            "handler" => $handler
        ];
    }


    public function checkSession($requestPath)
    {
        if (!isset($_SESSION['user']) && $requestPath != '/login' && $requestPath != '/signup') {
            header("Location: /notPinterest/login");
            exit();
        }
    }

    public function run()
    {
        $requestPath = isset($_GET["path"]) ? "/" . $_GET["path"] : "/";
        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;

        foreach ($this->handlers as $handler) {

            if ($handler["path"] == $requestPath && $handler["method"] == $method) {
                $callback = $handler["handler"];
            }
        }
        $this->checkSession($requestPath);

        if (!$callback) {
            header("Location: /notPinterest/login");
            return;
        }

        call_user_func_array($callback, array_merge($_GET, $_POST));
    }
}

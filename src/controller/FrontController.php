<?php
namespace Src\Controller;

class FrontController {

    private $indexRoute = "vinho";

    private $routes = [
        ["vinho", "Src\Controller\Http\VinhoController"],
        ["vinho-pedido", "Src\Controller\Http\VinhoPedidoController"]
    ];

    public function __construct($uri, $requestMethod, $params)
    {        
        $arrayRoutesKey = false;

        // define por padrão o indexRoute
        $controllerRoute = $this->routes[array_search($this->indexRoute, array_column($this->routes, '0'))];

        if (isset($uri[1]))
            $arrayRoutesKey = array_search($uri[1], array_column($this->routes, '0'));

        if ($arrayRoutesKey !== false)
            $controllerRoute = $this->routes[$arrayRoutesKey];

        $controller = new $controllerRoute[1]($requestMethod, $params);
        
        // print_r($controllerRoute);
        // print_r($uri);
        // print_r($requestMethod);
        // print_r($params);
    }
}
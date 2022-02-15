<?php
namespace Src\Controller;

class FrontController {

    private $indexRoute = "item";

    private $routes = [
        ["item", "Src\Controller\Http\ItemController"],
        ["item-pedido", "Src\Controller\Http\ItemPedidoController"]
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

        $controller = new $controllerRoute[1]($requestMethod, $uri, $params);

    }
}
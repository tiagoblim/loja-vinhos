<?php
require "vendor/autoload.php";
require "properties.php";

use Src\Controller\FrontController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = array_values(array_filter(explode( '/', $uri ), 'strlen'));

$requestMethod = $_SERVER["REQUEST_METHOD"];

$params = $_REQUEST;

$frontController = new FrontController($uri, $requestMethod, $params);
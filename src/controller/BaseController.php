<?php
namespace Src\Controller;

use Src\System\DatabaseConnector;
use Src\Controller\Response;
use Src\Model\Repository\BaseRepository;

abstract class BaseController {

    protected $requestMethod;
    protected $params;
    protected $uri;
    protected $response;

    public function __construct(string $requestMethod, array $uri, array $params)
    {
        $this->requestMethod = $requestMethod;
        $this->params = $params;
        $this->uri = $uri;
        $this->response = new Response();

        $this->processRequest();
    }

    protected function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->get();
                break;
            case 'POST':
                $response = $this->post();
                break;
            case 'PUT':
                $response = $this->put();
                break;
            case 'DELETE':
                $response = $this->delete();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($this->response->getStatusCodeHeader());
        if ($this->response->getBody()) {
            echo $this->response->getBody();
        }
    }

    protected function get() : Response {
        return $this->notFoundResponse();
    }

    protected function post() : Response {
        return $this->notFoundResponse();
    }

    protected function put() : Response {
        return $this->notFoundResponse();
    }

    protected function delete() : Response {
        return $this->notFoundResponse();
    }

    protected function unprocessableEntityResponse() : Response
    {
        $this->response->setStatusCodeHeader('HTTP/1.1 422 Unprocessable Entity');
        $this->response->setBody([
            'error' => 'Invalid input'
        ]);
        return $this->response;
    }

    protected function notFoundResponse() : Response
    {
        $this->response->setStatusCodeHeader('HTTP/1.1 404 Not Found');
        $this->response->setBody([]);

        return $this->response;
    }

    protected function getPhpInput () : array
    {
        return (array) json_decode(file_get_contents('php://input'), TRUE);
    }
}
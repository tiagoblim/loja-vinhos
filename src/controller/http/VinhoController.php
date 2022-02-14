<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Controller\Response;
use Src\Model\Repository\VinhoRepository;

class VinhoController extends BaseController {

    protected function get() : Response {
        return $this->findAll ();
    }

    private function findAll () : Response
    {
        try {
            $vinhoList = $this->getRepository()->findAll();
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setStatusCodeHeader('HTTP/1.1 200 OK');
        $this->response->setBody($vinhoList);
        return $this->response;
    }

    private function findById (int $id) : Response
    {
        try {
            $vinhoList = $this->getRepository()->findById($id);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setStatusCodeHeader('HTTP/1.1 200 OK');
        $this->response->setBody([$vinhoList]);
        return $this->response;
    }

    function getRepository () : VinhoRepository
    {
        return new VinhoRepository();
    }

}
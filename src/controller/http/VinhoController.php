<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Controller\Response;
use Src\Model\Repository\VinhoRepository;
use Src\Model\Mapper\VinhoMapper;
use Src\Model\Entity\Vinho;

class VinhoController extends BaseController {

    protected function get () : Response
    {
        if (isset($this->uri[2]))
            return $this->findById($this->uri[2]);
        else
            return $this->findAll ();
    }

    protected function post () : Response
    {
        $input = $this->getPhpInput();
        $vinho = new Vinho;
        $vinho->define(0, $input['nome'], $input['tipo'], $input['peso']);
    
        return $this->insert($vinho);
    }

    protected function put () : Response
    {
        $input = $this->getPhpInput();
        $vinho = new Vinho;
        $vinho->define($input['id'], $input['nome'], $input['tipo'], $input['peso']);

        return $this->update($vinho);
    }

    protected function delete () : Response
    {
        if (isset($this->uri[2]))
            return $this->remove($this->uri[2]);
        else
            return $this->unprocessableEntityResponse();
    }

    private function findAll () : Response
    {
        try {
            $vinhoList = $this->getRepository()->findAll();
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setBody($this->getMapper()->objectListToArray($vinhoList));
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

        $this->response->setBody($this->getMapper()->objectToArray($vinhoList));
        return $this->response;
    }

    private function insert (Vinho $vinho) : Response
    {
        try {
            $this->getRepository()->insert($vinho);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setStatusCodeHeader('HTTP/1.1 201 Created');
        return $this->response;
    }

    private function update (Vinho $vinho) : Response
    {
        try {
            $this->getRepository()->update($vinho);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        return $this->response;
    }

    private function remove (int $id) : Response
    {
        try {
            $this->getRepository()->delete($id);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        return $this->response;
    }

    function getRepository () : VinhoRepository
    {
        return new VinhoRepository();
    }

    function getMapper () : VinhoMapper
    {
        return new VinhoMapper();
    }

}
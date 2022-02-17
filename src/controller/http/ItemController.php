<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Controller\Response;
use Src\Model\Repository\ItemRepository;
use Src\Model\Mapper\ItemMapper;
use Src\Model\Entity\Item;

class ItemController extends BaseController {

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
        $item = new Item();
        $item->define(0, $input['nome'], $input['tipo'], $input['peso'], $input['preco']);
    
        return $this->insert($item);
    }

    protected function put () : Response
    {
        $input = $this->getPhpInput();
        $item = new Item();
        $item->define($input['id'], $input['nome'], $input['tipo'], $input['peso'], $input['preco']);

        return $this->update($item);
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
            $itemList = $this->getRepository()->findAll();
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setBody($this->getMapper()->objectListToArray($itemList));
        return $this->response;
    }

    private function findById (int $id) : Response
    {
        try {
            $itemList = $this->getRepository()->findById($id);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setBody($this->getMapper()->objectToArray($itemList));
        return $this->response;
    }

    private function insert (Item $item) : Response
    {
        try {
            $this->getRepository()->insert($item);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setStatusCodeHeader('HTTP/1.1 201 Created');
        return $this->response;
    }

    private function update (Item $item) : Response
    {
        try {
            $this->getRepository()->update($item);
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

    function getRepository () : ItemRepository
    {
        return new ItemRepository();
    }

    function getMapper () : ItemMapper
    {
        return new ItemMapper();
    }

}
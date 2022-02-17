<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Controller\Response;
use Src\Model\Repository\ItemPedidoRepository;
use Src\Model\Mapper\ItemPedidoMapper;
use Src\Model\Entity\ItemPedido;

class ItemPedidoController extends BaseController {

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
        $itemPedido = new ItemPedido();
        $itemPedido->define(0, $input['itemId'], $input['pedidoId'], $input['quantidade']);
    
        return $this->insert($itemPedido);
    }

    protected function put () : Response
    {
        $input = $this->getPhpInput();
        $itemPedido = new ItemPedido();
        $itemPedido->define($input['id'], $input['itemId'], $input['pedidoId'], $input['quantidade']);

        return $this->update($itemPedido);
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
            $itemPedidoList = $this->getRepository()->findAll();
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setBody($this->getMapper()->objectListToArray($itemPedidoList));
        return $this->response;
    }

    private function findById (int $id) : Response
    {
        try {
            $itemPedidoList = $this->getRepository()->findById($id);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setBody($this->getMapper()->objectToArray($itemPedidoList));
        return $this->response;
    }

    private function insert (ItemPedido $itemPedido) : Response
    {
        try {
            $this->getRepository()->insert($itemPedido);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setStatusCodeHeader('HTTP/1.1 201 Created');
        return $this->response;
    }

    private function update (ItemPedido $itemPedido) : Response
    {
        try {
            $this->getRepository()->update($itemPedido);
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

    function getRepository () : ItemPedidoRepository
    {
        return new ItemPedidoRepository();
    }

    function getMapper () : ItemPedidoMapper
    {
        return new ItemPedidoMapper();
    }

}
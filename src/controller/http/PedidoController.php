<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Controller\Response;
use Src\Model\Repository\PedidoRepository;
use Src\Model\Mapper\PedidoMapper;
use Src\Service\PedidoService;
use Src\Model\Entity\Pedido;

class PedidoController extends BaseController {

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
        $pedido = new Pedido();
        $pedido->define(0, $input['valor'], $input['frete'], $input['distancia_entrega']);
    
        return $this->insert($pedido);
    }

    protected function put () : Response
    {
        $input = $this->getPhpInput();
        $pedido = new Pedido();
        $pedido->define($input['id'], $input['valor'], $input['frete'], $input['distancia_entrega']);

        return $this->update($pedido);
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
            $pedidoList = $this->getRepository()->findAll();
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setBody($this->getMapper()->objectListToArray($pedidoList));
        return $this->response;
    }

    private function findById (int $id) : Response
    {
        try {
            $pedidoList = $this->getRepository()->findById($id);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setBody($this->getMapper()->objectToArray($pedidoList));
        return $this->response;
    }

    private function insert (Pedido $pedido) : Response
    {
        try {
            $this->getService()->insert($pedido);
        }
        catch (\PDOException $e) {
            return $this->unprocessableEntityResponse();
        }

        $this->response->setStatusCodeHeader('HTTP/1.1 201 Created');
        return $this->response;
    }

    private function update (Pedido $pedido) : Response
    {
        try {
            $this->getService()->update($pedido);
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

    function getRepository () : PedidoRepository
    {
        return new PedidoRepository();
    }

    function getMapper () : PedidoMapper
    {
        return new PedidoMapper();
    }

    function getService () : PedidoService
    {
        return new PedidoService();
    }

}
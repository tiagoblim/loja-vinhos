<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Controller\Response;
use Src\Model\Repository\VinhoPedidoRepository;

class VinhoPedidoController extends BaseController {

    protected function get() : Response {
        $this->response->setStatusCodeHeader('HTTP/1.1 200 OK');
        $this->response->setBody([
            'teste' => 'Vinho Pedido'
        ]);
        return $this->response;
    }

    function getRepository () : VinhoPedidoRepository
    {
        return new VinhoPedidoRepository();
    }

}
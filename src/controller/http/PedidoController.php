<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Model\Repository\PedidoRepository;
use Src\Model\Mapper\PedidoMapper;
use Src\Service\PedidoService;

class PedidoController extends BaseController {

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
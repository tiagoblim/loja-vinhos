<?php
namespace Src\Controller\Http;

use Src\Controller\BaseController;
use Src\Model\Repository\ItemPedidoRepository;
use Src\Model\Mapper\ItemPedidoMapper;

class ItemPedidoController extends BaseController {

    function getRepository () : ItemPedidoRepository
    {
        return new ItemPedidoRepository();
    }

    function getMapper () : ItemPedidoMapper
    {
        return new ItemPedidoMapper();
    }

}
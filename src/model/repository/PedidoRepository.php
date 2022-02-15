<?php
namespace Src\Model\Repository;

use Src\Model\Entity\Pedido;
use Src\Model\Mapper\PedidoMapper;

class PedidoRepository extends BaseRepository {

    protected function getMapper () : PedidoMapper
    {
        return new PedidoMapper();
    }
}
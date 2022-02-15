<?php
namespace Src\Model\Repository;

use Src\Model\Entity\ItemPedido;
use Src\Model\Mapper\ItemPedidoMapper;

class ItemPedidoRepository extends BaseRepository {

    protected function getMapper () : ItemPedidoMapper
    {
        return new ItemPedidoMapper();
    }
}
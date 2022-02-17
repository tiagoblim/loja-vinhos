<?php
namespace Src\Model\Mapper;

use Src\Model\Entity\ItemPedido;

class ItemPedidoMapper extends BaseMapper {

    public function arrayToObject (array $itemPedidoArray) : ItemPedido
    {
        $itemPedido = new ItemPedido();

        try {
            $itemPedido->define (
                $itemPedidoArray['id'],
                $itemPedidoArray['itemId'],
                $itemPedidoArray['pedidoId'],
                $itemPedidoArray['quantidade']
            );
        }
        catch (\Exception $e) {            
            return null;
        }

        return $itemPedido;
    }

    public function arrayToObjectList (array $itemPedidoListArray) : array
    {
        $itemPedidoList = [];

        try {
            foreach ($itemPedidoListArray as $itemPedidoArray) {
                $itemPedido = $this->arrayToObject($itemPedidoArray);
                array_push($itemPedidoList, $itemPedido);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return $itemPedidoList;
    }

    public function objectToArray ($itemPedidoObject) : array
    {
        return [
            "id"         => $itemPedidoObject->getId(),
            "itemId"     => $itemPedidoObject->getItemId(),
            "pedidoId"   => $itemPedidoObject->getPedidoId(),
            "quantidade" => $itemPedidoObject->getQuantidade()
        ];
    }

    public function objectListToArray (array $itemPedidoObjectList) : array
    {
        $itemPedidoList = [];

        try {
            foreach ($itemPedidoObjectList as $itemPedido) {
                $itemPedidoArray = $this->objectToArray($itemPedido);
                array_push($itemPedidoList, $itemPedidoArray);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return (array) $itemPedidoList;
    }
}
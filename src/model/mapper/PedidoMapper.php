<?php
namespace Src\Model\Mapper;

use Src\Model\Entity\Pedido;

class PedidoMapper extends BaseMapper {
 
    public function arrayToObject (array $pedidoArray) : Pedido
    {
        $pedido = new Pedido();
        $itensPedidoId = explode(",", $pedidoArray['itensPedidoId']);

        if (strlen($pedidoArray['itensPedidoId']) > 0)
            $itensPedidoId = array_map('intval', $itensPedidoId);
        else
            $itensPedidoId = [];

        try {
            $pedido->define (
                $pedidoArray['id'],
                $pedidoArray['valor'],
                $pedidoArray['peso'],
                $pedidoArray['frete'],
                $pedidoArray['distancia_entrega'],
                $itensPedidoId
            );
        }
        catch (\Exception $e) {            
            return null;
        }

        return $pedido;
    }

    public function arrayToObjectList (array $pedidoListArray) : array
    {
        $pedidoList = [];

        try {
            foreach ($pedidoListArray as $pedidoArray) {
                $pedido = $this->arrayToObject($pedidoArray);
                array_push($pedidoList, $pedido);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return $pedidoList;
    }

    public function objectToArray ($pedidoObject) : array
    {
        return [
            "id"                => $pedidoObject->getId(),
            "valor"             => $pedidoObject->getValor(),
            "peso"              => $pedidoObject->getPeso(),
            "frete"             => $pedidoObject->getFrete(),
            "distancia_entrega" => $pedidoObject->getDistanciaEntrega(),
            "itensPedidoId"     => $pedidoObject->getItensPedidoId()
        ];
    }

    public function objectListToArray (array $pedidoObjectList) : array
    {
        $pedidoList = [];

        try {
            foreach ($pedidoObjectList as $pedido) {
                $pedidoArray = $this->objectToArray($pedido);
                array_push($pedidoList, $pedidoArray);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return (array) $pedidoList;
    }
}
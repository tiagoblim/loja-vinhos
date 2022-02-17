<?php
namespace Src\Model\Mapper;

use Src\Model\Entity\Item;

class ItemMapper extends BaseMapper {
    
    public function arrayToObject (array $itemArray) : Item
    {
        $item = new Item();
        
        try {
            $item->define (
                $itemArray['id'],
                $itemArray['nome'],
                $itemArray['tipo'],
                $itemArray['peso'],
                $itemArray['preco']
            );
        }
        catch (\Exception $e) {            
            return null;
        }

        return $item;
    }

    public function arrayToObjectList (array $itemListArray) : array
    {
        $itemList = [];

        try {
            foreach ($itemListArray as $itemArray) {
                $item = $this->arrayToObject($itemArray);
                array_push($itemList, $item);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return $itemList;
    }

    public function objectToArray ($itemObject) : array
    {
        return [
            "id"   => $itemObject->getId(),
            "nome" => $itemObject->getNome(),
            "tipo" => $itemObject->getTipo(),
            "peso" => $itemObject->getPeso(),
            "preco" => $itemObject->getPreco()
        ];
    }

    public function objectListToArray (array $itemObjectList) : array
    {
        $itemList = [];

        try {
            foreach ($itemObjectList as $item) {
                $itemArray = $this->objectToArray($item);
                array_push($itemList, $itemArray);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return (array) $itemList;
    }
}
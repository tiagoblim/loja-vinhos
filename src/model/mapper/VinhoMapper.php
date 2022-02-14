<?php
namespace Src\Model\Mapper;

use Src\Model\Entity\Vinho;

class VinhoMapper extends BaseMapper {
    
    public function arrayToObject (array $vinhoArray) : Vinho
    {
        $vinho = new Vinho();
        
        try {
            $vinho->define (
                $vinhoArray['id'],
                $vinhoArray['nome'],
                $vinhoArray['tipo'],
                $vinhoArray['peso']
            );
        }
        catch (\Exception $e) {            
            return null;
        }

        return $vinho;
    }

    public function arrayToObjectList (array $vinhoListArray) : array
    {
        $vinhoList = [];

        try {
            foreach ($vinhoListArray as $vinhoArray) {
                $vinho = $this->arrayToObject($vinhoArray);
                array_push($vinhoList, $vinho);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return $vinhoList;
    }

    public function objectToArray (Vinho $vinhoObject) : array
    {
        return [
            "id" => $vinhoObject->getId(),
            "nome" => $vinhoObject->getNome(),
            "tipo" => $vinhoObject->getTipo(),
            "peso" => $vinhoObject->getPeso()
        ];
        return (array) $vinhoObject;
    }

    public function objectListToArray (array $vinhoObjectList) : array
    {
        $vinhoList = [];

        try {
            foreach ($vinhoObjectList as $vinho) {
                $vinhoArray = $this->objectToArray($vinho);
                array_push($vinhoList, $vinhoArray);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return (array) $vinhoList;
    }
}
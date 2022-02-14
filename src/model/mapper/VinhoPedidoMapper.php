<?php
namespace Src\Model\Mapper;

use Src\Model\Entity\Vinho;

class VinhoPedidoMapper extends BaseMapper {
    
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
                array_push($vinhoList, $vinhoArray);
            }
        }
        catch (\Exception $e) {            
            return null;
        }

        return $vinhoList;
    }
}
<?php
namespace Src\Model\Repository;

use Src\Model\Entity\Vinho;
use Src\Model\Mapper\VinhoMapper;

class VinhoPedidoRepository extends BaseRepository {

    private function __construct()
    {
        $this->VinhoMapper = new VinhoMapper();
    }
    
    public function findAll() : array
    {
        $statement = "
            SELECT 
                id, nome, tipo, peso
            FROM
                vinho;
        ";

        try {
            $statement = $this->dbConnection()->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $this->getMapper()->arrayToObjectList($result);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function findById($id) : Vinho
    {
        $statement = "
            SELECT 
                id, nome, tipo, peso
            FROM
                vinho
            WHERE id = ?;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $this->getMapper()->arrayToObject($result);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function insert(Vinho $vinho) : void
    {
        $statement = "
            INSERT INTO vinho 
                (nome, tipo, peso)
            VALUES
                (:nome, :tipo, :peso);
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array(
                'nome' => $vinho->getNome(),
                'tipo'  => $vinho->getTipo(),
                'peso' => $vinho->getPeso(),
            ));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete(Vinho $vinho) : void
    {
        $statement = "
            DELETE FROM vinho
            WHERE id = :id;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array('id' => $vinho->getId()));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    protected function getMapper () : VinhoMapper
    {
        return new VinhoMapper();
    }
}
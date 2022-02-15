<?php
namespace Src\Model\Repository;

use Src\Model\Entity\Item;
use Src\Model\Mapper\ItemMapper;

class ItemRepository extends BaseRepository {
    
    public function findAll() : array
    {
        $statement = "
            SELECT 
                id, nome, tipo, peso
            FROM
                item;
        ";

        try {
            $statement = $this->dbConnection()->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $this->getMapper()->arrayToObjectList($result);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function findById($id) : Item
    {
        $statement = "
            SELECT 
                id, nome, tipo, peso
            FROM
                item
            WHERE id = ?;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $this->getMapper()->arrayToObject($result[0]);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function insert(Item $item) : void
    {
        $statement = "
            INSERT INTO item 
                (nome, tipo, peso)
            VALUES
                (:nome, :tipo, :peso);
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array(
                'nome' => $item->getNome(),
                'tipo' => $item->getTipo(),
                'peso' => $item->getPeso(),
            ));

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update(Item $item) : void
    {
        $statement = "
            UPDATE item
            SET 
                nome = :nome,
                tipo = :tipo,
                peso = :peso
            WHERE id = :id;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array(
                'id'   => (int) $item->getId(),
                'nome' => $item->getNome(),
                'tipo' => $item->getTipo(),
                'peso' => $item->getPeso(),
            ));

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete(int $id) : void
    {
        $statement = "
            DELETE FROM item
            WHERE id = :id;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array('id' => $id));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    protected function getMapper () : ItemMapper
    {
        return new ItemMapper();
    }
}
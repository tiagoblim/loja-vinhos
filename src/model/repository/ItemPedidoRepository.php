<?php
namespace Src\Model\Repository;

use Src\Model\Entity\ItemPedido;
use Src\Model\Mapper\ItemPedidoMapper;

class ItemPedidoRepository extends BaseRepository {

    public function findAll() : array
    {
        $statement = "
            SELECT 
                id, quantidade, itemId, pedidoId
            FROM
                item_pedido;
        ";

        try {
            $statement = $this->dbConnection()->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $this->getMapper()->arrayToObjectList($result);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function findById($id) : ItemPedido
    {
        $statement = "
            SELECT 
                id, quantidade, itemId, pedidoId
            FROM
                item_pedido
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

    public function insert(ItemPedido $item) : void
    {
        $statement = "
            INSERT INTO item_pedido 
                (quantidade, itemId, pedidoId)
            VALUES
                (:quantidade, :itemId, :pedidoId);
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array(
                'quantidade' => $item->getQuantidade(),
                'itemId' => $item->getItemId(),
                'pedidoId' => $item->getPedidoId(),
            ));

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update(ItemPedido $item) : void
    {
        $statement = "
            UPDATE item_pedido
            SET 
                quantidade = :quantidade,
                itemId     = :itemId,
                pedidoId   = :pedidoId
            WHERE id = :id;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array(
                'id'   => (int) $item->getId(),
                'quantidade' => $item->getQuantidade(),
                'itemId' => $item->getItemId(),
                'pedidoId' => $item->getPedidoId(),
            ));

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete(int $id) : void
    {
        $statement = "
            DELETE FROM item_pedido
            WHERE id = :id;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array('id' => $id));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    protected function getMapper () : ItemPedidoMapper
    {
        return new ItemPedidoMapper();
    }
    
}
<?php
namespace Src\Model\Repository;

use Src\Model\Entity\Pedido;
use Src\Model\Mapper\PedidoMapper;

class PedidoRepository extends BaseRepository {

    public function findAll() : array
    {
        $statement = "
        SELECT 
            pedido.id, pedido.valor, pedido.peso, pedido.frete, distancia_entrega,
            ( 
                SELECT
                    GROUP_CONCAT(item_pedido.id)
                FROM
                    item_pedido
                WHERE
                    item_pedido.pedidoId = pedido.id
                GROUP BY item_pedido.pedidoId
            )
            as itensPedidoId
        FROM
            pedido;
        ";

        try {
            $statement = $this->dbConnection()->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $this->getMapper()->arrayToObjectList($result);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function findById($id) : Pedido
    {
        $statement = "
            SELECT 
                pedido.id, pedido.valor, pedido.frete, pedido.peso, pedido.distancia_entrega,
                ( 
                    SELECT
                        GROUP_CONCAT(item_pedido.id)
                    FROM
                        item_pedido
                    WHERE
                        item_pedido.pedidoId = pedido.id
                    GROUP BY item_pedido.pedidoId
                )
                as itensPedidoId
            FROM
                pedido
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

    public function insert(Pedido $pedido) : void
    {
        $statement = "
            INSERT INTO pedido 
                (valor, peso, frete, distancia_entrega)
            VALUES
                (:valor, :peso, :frete, :distancia_entrega);
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array(
                'valor'             => $pedido->getValor(),
                'peso'              => $pedido->getPeso(),
                'frete'             => $pedido->getFrete(),
                'distancia_entrega' => $pedido->getDistanciaEntrega(),
            ));

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update(Pedido $pedido) : void
    {
        $statement = "
            UPDATE pedido
            SET 
                valor             = :valor,
                peso              = :peso,
                frete             = :frete,
                distancia_entrega = :distancia_entrega
            WHERE id = :id;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array(
                'id'                => (int) $pedido->getId(),
                'valor'             => $pedido->getValor(),
                'peso'              => $pedido->getPeso(),
                'frete'             => $pedido->getFrete(),
                'distancia_entrega' => $pedido->getDistanciaEntrega(),
            ));

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete(int $id) : void
    {
        $statement = "
            DELETE FROM pedido
            WHERE id = :id;
        ";

        try {
            $statement = $this->dbConnection()->prepare($statement);
            $statement->execute(array('id' => $id));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    protected function getMapper () : PedidoMapper
    {
        return new PedidoMapper();
    }
}
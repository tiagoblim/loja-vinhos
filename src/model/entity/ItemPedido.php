<?php
namespace Src\Model\Entity;

class ItemPedido extends BaseEntity {

    private $id;
    private $itemId;
    private $pedidoId;
    private $quantidade;

    function define(int $id, int $itemId, int $pedidoId, int $quantidade) : void
    {
        $this->id         = $id;
        $this->itemId     = $itemId;
        $this->pedidoId   = $pedidoId;
        $this->quantidade = $quantidade;
    }

    function getId () : int
    {
        return $this->id;
    }

    function setId(int $id) : void
    {
        $this->id = $id;
    }

    function getItemId () : int
    {
        return $this->itemId;
    }

    function setItemId(int $itemId) : void
    {
        $this->itemId = $itemId;
    }

    function getPedidoId () : int
    {
        return $this->pedidoId;
    }

    function setPedidoId(int $pedidoId) : void
    {
        $this->pedidoId = $pedidoId;
    }

    function getQuantidade () : int
    {
        return $this->quantidade;
    }

    function setQuantidade(int $quantidade) : void
    {
        $this->quantidade = $quantidade;
    }

}
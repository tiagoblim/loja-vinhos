<?php
namespace Src\Model\Entity;

class ItemPedido extends BaseEntity {

    private $id;
    private $item;
    private $pedido;
    private $quantidade;

    function define(int $id, Item $item, Pedido $pedido, int $quantidade) : void
    {
        $this->id         = $id;
        $this->item       = $item;
        $this->pedido     = $pedido;
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

    function getItem () : Item
    {
        return $this->item;
    }

    function setItem(Item $item) : void
    {
        $this->item = $item;
    }

    function getItemPedidoId () : Pedido
    {
        return $this->pedido;
    }

    function setItemPedidoId(Pedido $pedido) : void
    {
        $this->pedido = $pedido;
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
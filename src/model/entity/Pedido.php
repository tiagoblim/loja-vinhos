<?php
namespace Src\Model\Entity;

class Pedido extends BaseEntity {

    private $id;
    private $valor;
    private $peso;
    private $frete;
    private $distancia_entrega;
    private $itensPedidoId; //Apenas leitura

    function define(int $id, float $valor, float $peso, float $frete, float $distancia_entrega, array $itensPedidoId = []) : void
    {
        $this->id                = $id;
        $this->valor             = $valor;
        $this->peso              = $peso;
        $this->frete             = $frete;
        $this->distancia_entrega = $distancia_entrega;
        $this->itensPedidoId     = $itensPedidoId;
    }

    function getId () : int
    {
        return $this->id;
    }

    function setId(int $id) : void
    {
        $this->id = $id;
    }

    function getValor () : float
    {
        return $this->valor;
    }

    function setValor(int $valor) : void
    {
        $this->valor = $valor;
    }

    function getPeso () : float
    {
        return $this->peso;
    }

    function setPeso(int $peso) : void
    {
        $this->peso = $peso;
    }
    
    function getFrete () : float
    {
        return $this->frete;
    }

    function setFrete(int $frete) : void
    {
        $this->frete = $frete;
    }

    function getDistanciaEntrega () : float
    {
        return $this->distancia_entrega;
    }

    function setDistanciaEntrega(int $distancia_entrega) : void
    {
        $this->distancia_entrega = $distancia_entrega;
    }

    function getItensPedidoId () : array
    {
        return $this->itensPedidoId;
    }

    function setItensPedidoId(array $itensPedidoId) : void
    {
        $this->itensPedidoId = $itensPedidoId;
    }

}
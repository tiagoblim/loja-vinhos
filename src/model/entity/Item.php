<?php
namespace Src\Model\Entity;

class Item extends BaseEntity {

    private $id;
    private $nome;
    private $tipo;
    private $peso;
    private $preco;

    function define(int $id, string $nome, string $tipo, float $peso, float $preco) : void
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->peso = $peso;
        $this->preco = $preco;
    }

    function getId () : int
    {
        return $this->id;
    }

    function setId(int $id) : void
    {
        $this->id = $id;
    }

    function getNome () : string
    {
        return $this->nome;
    }

    function setNome(string $nome) : void
    {
        $this->nome = $nome;
    }

    function getTipo () : string
    {
        return $this->tipo;
    }

    function setTipo(string $tipo) : void
    {
        $this->tipo = $tipo;
    }

    function getPeso () : float
    {
        return $this->peso;
    }

    function setPeso(float $peso) : void
    {
        $this->peso = $peso;
    }

    function getPreco () : float
    {
        return $this->preco;
    }

    function setPreco(float $preco) : void
    {
        $this->preco = $preco;
    }
}
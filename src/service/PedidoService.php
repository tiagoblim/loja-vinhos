<?php
namespace Src\Service;

use Src\Model\Repository\PedidoRepository;
use Src\Model\Repository\ItemPedidoRepository;
use Src\Model\Repository\ItemRepository;
use Src\Model\Entity\Pedido;

class PedidoService extends BaseService {

    private const PRECO_POR_QUILO = 5;
    private const DISTANCIA_PADRAO = 100;

    public function insert (Pedido $pedido) : void
    {
        $pedido->setFrete( $this->calcularFrete($pedido) );
        $pedido->setPeso( $this->calcularPeso($pedido) );
        $pedido->setValor( $this->calcularValor ($pedido) + $pedido->getFrete());
        $this->getRepository()->insert($pedido);
    }

    public function update (Pedido $pedido) : void
    {
        $pedido->setFrete( $this->calcularFrete($pedido) );
        $pedido->setPeso( $this->calcularPeso($pedido) );
        $pedido->setValor( $this->calcularValor ($pedido) + $pedido->getFrete());
        $this->getRepository()->update($pedido);
    }

    public function calcularFrete (Pedido $pedido) : float
    {
        $frete = 0;
        $valorPeloPeso = $this->calcularPeso($pedido) * $this::PRECO_POR_QUILO;

        if ($pedido->getDistanciaEntrega() <= $this::DISTANCIA_PADRAO) {
            $frete = $valorPeloPeso;
        }
        else {
            $frete = (( $valorPeloPeso * $pedido->getDistanciaEntrega() ) / 100);
        }

        return $frete;

    }

    public function calcularPeso (Pedido $pedido) : float
    {
        $peso = 0;

        foreach ($pedido->getItensPedidoId() as $itemPedidoId) {
            $itemPedido = $this->getItemPedidoRepository()->findById($itemPedidoId);
            $item = $this->getItemRepository()->findById($itemPedido->getItemId());
            $peso += ($item->getPeso() * $itemPedido->getQuantidade());
        }

        return $peso;
    }

    public function calcularValor (Pedido $pedido) : float
    {
        $valor = 0;

        foreach ($pedido->getItensPedidoId() as $itemPedidoId) {
            $itemPedido = $this->getItemPedidoRepository()->findById($itemPedidoId);
            $item = $this->getItemRepository()->findById($itemPedido->getItemId());
            $valor += $item->getPreco();
        }

        return $valor;
    }

    protected function getRepository () : PedidoRepository
    {
        return new PedidoRepository();
    }

    protected function getItemPedidoRepository () : ItemPedidoRepository
    {
        return new ItemPedidoRepository();
    }

    protected function getItemRepository () : ItemRepository
    {
        return new ItemRepository();
    }
}
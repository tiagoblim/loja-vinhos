<?php
namespace Src\Service;

use Src\Model\Repository\PedidoRepository;

class PedidoService extends BaseService {

    protected function getRepository () : PedidoRepository
    {
        return new PedidoRepository();
    }
}
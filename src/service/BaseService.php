<?php
namespace Src\Service;

use Src\Model\Repository\BaseRepository;

abstract class BaseService {

    protected abstract function getRepository () : BaseRepository;

}
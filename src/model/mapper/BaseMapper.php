<?php
namespace Src\Model\Mapper;

use Src\Model\Entity\BaseEntity;

abstract class BaseMapper {

    public abstract function arrayToObject (array $Array) : BaseEntity;

    public abstract function arrayToObjectList (array $listArray) : array;
}
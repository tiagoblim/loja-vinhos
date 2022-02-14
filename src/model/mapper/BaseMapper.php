<?php
namespace Src\Model\Mapper;

use Src\Model\Entity\BaseEntity;

abstract class BaseMapper {

    public abstract static function arrayToObject (array $Array) : BaseEntity;

    public abstract static function arrayToObjectList (array $listArray) : array;
}
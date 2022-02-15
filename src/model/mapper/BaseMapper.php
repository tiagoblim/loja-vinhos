<?php
namespace Src\Model\Mapper;

abstract class BaseMapper {

    public abstract function arrayToObject (array $Array);

    public abstract function arrayToObjectList (array $listArray) : array;

    public abstract function objectToArray ($itemObject) : array;

    public abstract function objectListToArray (array $itemObjectList) : array;
}
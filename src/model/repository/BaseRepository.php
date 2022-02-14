<?php
namespace Src\Model\Repository;

use Src\Model\Mapper\BaseMapper;
use Src\System\DatabaseConnector;

abstract class BaseRepository {

    final protected function exec(string $statement)
    {
        $this->dbConnection()->exec($statement);
    }

    final protected function dbConnection() : \PDO
    {
        return (new DatabaseConnector())->getConnection();
    }

    protected abstract function getMapper () : BaseMapper;

}
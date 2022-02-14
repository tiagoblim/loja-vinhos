<?php
require "properties.php";
require 'src/system/DatabaseConnector.php';

use Src\System\DatabaseConnector;

$dbConnection = (new DatabaseConnector())->getConnection();

$statement = <<<EOS
    CREATE TABLE IF NOT EXISTS vinho (
        id BIGINT NOT NULL AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        tipo VARCHAR(100) NOT NULL,
        peso INTEGER NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    INSERT INTO vinho
        (id, nome, tipo, peso)
    VALUES
        (1, 'Vinho do Porto', 'Tannat', 400),
        (2, 'Serra Gaúcha', 'Merlot', 500),
        (3, 'Santo Antônio', 'Malbec', 500);
EOS;

try {
    $createTable = $dbConnection->exec($statement);
    echo "Success!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}
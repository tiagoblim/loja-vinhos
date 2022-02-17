<?php
require "properties.php";
require 'src/system/DatabaseConnector.php';

use Src\System\DatabaseConnector;

$dbConnection = (new DatabaseConnector())->getConnection();

$statements = [
    "CREATE TABLE IF NOT EXISTS item (
        id BIGINT NOT NULL AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        tipo VARCHAR(100) NOT NULL,
        peso DECIMAL(10,3) NOT NULL,
        preco DECIMAL(10,3) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    INSERT INTO item
        (id, nome, tipo, peso, preco)
    VALUES
        (1, 'Vinho do Porto', 'Tannat', 0.5, 500),
        (2, 'Serra Gaúcha', 'Merlot', 0.5, 100),
        (3, 'Santo Antônio', 'Malbec', 0.4, 25);",

    "CREATE TABLE IF NOT EXISTS pedido (
        id BIGINT NOT NULL AUTO_INCREMENT,
        valor DECIMAL(10,3) NOT NULL,
        peso DECIMAL(10,3) NOT NULL,
        frete BIGINT NOT NULL,
        distancia_entrega DECIMAL(10,3) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    INSERT INTO pedido
        (id, valor, peso, frete, distancia_entrega)
    VALUES
        (1, 1550, 2, 18, 150);",

    "CREATE TABLE IF NOT EXISTS item_pedido (
        id BIGINT NOT NULL AUTO_INCREMENT,
        quantidade BIGINT NOT NULL,
        itemId BIGINT NOT NULL,
        pedidoId BIGINT NOT NULL,
        PRIMARY KEY (id),
        CONSTRAINT FK_itemId FOREIGN KEY (itemId) REFERENCES item(id),
        CONSTRAINT FK_pedidoId FOREIGN KEY (pedidoId) REFERENCES pedido(id)
    ) ENGINE=INNODB;

    INSERT INTO item_pedido
        (id, quantidade, itemId, pedidoId)
    VALUES
        (1, 3, 1, 1),
        (2, 2, 3, 1);"
];

try {
    foreach ($statements as $statement) {
        $dbConnection->exec($statement);
    }
    echo "Sucesso!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}
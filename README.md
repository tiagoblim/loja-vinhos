# Desafio proposto pela softexpert

Uma antiga loja de vinhos gostaria de vender seus produtos também pela internet para aumentar o seu faturamento, com isso, o seu objetivo é desenvolver um pequeno e-commerce web.

## Pré-requisitos

###### O projeto foi desenvolvido usando-se as seguintes tecnologias:

- PHP 7.4;
- MySql 5.7;
- Apache 2.4 (com mod_rewrite ON);

Tudo foi testado em http://localhost/loja.

Antes de executar o projeto, configurar o arquivo /properties.php com as informações de acesso ao banco de dados:
```
<?php

define("DB_HOST", "localhost");
define("DB_PORT", "3306");
define("DB_DATABASE", "mysql");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
```

Então executar o arquivo /dbseed.php para criar a extrutura de tabelas e alguns dados de exemplo. (Utilizei o console do windows mesmo)
```
> php dbseed.php
```

## Como Usar

Dentro do repositório existe o arquivo */endpoints.postman_collection.json* que pode ser importado no Postman 2.1+ com todos os endpoints do projeto configurados. Mas abaixo segue um detalhamento deles com *Método HTTP, URI e corpo* a ser enviado como json quando necessário:

> GET http://localhost/loja/item
```
{}
```

> GET http://localhost/loja/item/1
```
{}
```
> POST http://localhost/loja/item
```
{
  "nome": "Rio Preto",
  "tipo": "Tinto",
  "peso": 600
}
```
> PUT http://localhost/loja/item
```
{
  "id": 4,
  "nome": "Rio Preto",
  "tipo": "Tinto",
  "peso": 400
}
```
> DEL http://localhost/loja/item/1
```
{}
```

> GET http://localhost/loja/pedido
```
{}
```

> GET http://localhost/loja/pedido/1
```
{}
```

> POST http://localhost/loja/pedido
```
{
  "distancia_entrega": 150
}
```
> PUT http://localhost/loja/pedido
```
{
  "id": 2,
  "distancia_entrega": 200
}
```
> DEL http://localhost/loja/pedido/1
```
{}
```

> GET http://localhost/loja/item-pedido
```
{}
```

> GET http://localhost/loja/item-pedido/1
```
{}
```

> POST http://localhost/loja/item-pedido
```
{
  "itemId": 3,
  "pedidoId": 2,
  "quantidade": 2
}
```
> PUT http://localhost/loja/item-pedido
```
{
  "id": 2,
  "itemId": 3,
  "pedidoId": 3,
  "quantidade": 2
}
```
> DEL http://localhost/loja/item-pedido/1
```
{}
```

## Cosiderações

Foi solicitado não se fazer o uso de nenhum framework e utilizar arquitetura REST.
Utilizei apenas o composer e seu autoloader, mas não fiz uso de nenhuma lib também.

Optei por utilizar uma série de design patterns populares. Em alguns momentos eu entendo que eles só se tornam realmente utéis quando utilizados juntos de um framwork, como é o caso do padrão Repository e Entity, que só se tornam práticos com o auxílio de um ORM, mas ainda assim achei que seria interessante demonstrar o uso simplificado na aplicação.

Sempre há mais coisas que poderiam ser feitas como o uso de um container de dependencias, não expor as entidades diretamente para o cliente via HTTP, usar uma forma mais automática de fazer o mapeamento entre as entidades e outros tipos, mas ainda assim considero ter alcançado um bom resultado.

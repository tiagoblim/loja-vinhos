<?php
namespace Src\Controller;

class Response {

    private $statusCodeHeader;

    private $body;

    function getStatusCodeHeader () : string
    {
        return $this->statusCodeHeader;
    }

    function setStatusCodeHeader(string $statusCodeHeader) : void
    {
        $this->statusCodeHeader = $statusCodeHeader;
    }

    function getBody () : string
    {
        return $this->body;
    }

    function setBody(array $body) : void
    {
        $this->body = json_encode($body);
    }
}
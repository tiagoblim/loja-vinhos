<?php
namespace Src\Controller;

class Response {

    private $statusCodeHeader;

    private $body;

    function __construct()
    {
        $this->setStatusCodeHeader('HTTP/1.1 200 OK');
        $this->setBody([]);
    }

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

    function setBody($body) : void
    {
        $this->body = json_encode($body);
    }
}
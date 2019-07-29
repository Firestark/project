<?php

namespace Firestark;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response as R;

class Response
{
    public function ok(string $body) : ResponseInterface
    {
        $response = new R;
        $response->getBody()->write($body);
        return $response->withStatus(200);
    }

    public function notFound(string $body) : ResponseInterface
    {
        $response = new R;
        $response->getBody()->write($body);
        return $response->withStatus(404);
    }
}
<?php

namespace Firestark;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response as R;

class Response implements ResponseFactoryInterface
{
    public function ok(string $body) : ResponseInterface
    {
        $response = new R;
        $response->getBody()->write($body);
        return $response->withHeader('content-type', 'text/html');
    }

    public function notFound(string $body) : ResponseInterface
    {
        $response = new R;
        $response->getBody()->write($body);
        $response = $response->withHeader('content-type', 'text/html');
        return $response->withStatus(404);
    }

    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        $response = new R;
        return $response->withStatus(404, $reasonPhrase);
    }
}
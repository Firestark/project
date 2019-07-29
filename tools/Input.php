<?php

namespace Firestark;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Server\MiddlewareInterface as Middleware;

class Input implements Middleware
{
    private $data = [];
    
    public function process(Request $request, Handler $handler): Response
    {
        parse_str($request->getBody()->getContents(), $input);
        $this->data = $input;
        return $handler->handle($request);
    }

    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->data;
    }
}

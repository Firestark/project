<?php

namespace Firestark\Json;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse as R;

class Response
{
    public function ok(int $status, $body = []): ResponseInterface
    {
        return new R(['status' => $status, 'body' => $body]); 
    }

    public function notFound(int $status, $body = []): ResponseInterface
    {
        return (new R(['status' => $status, 'body' => $body]))->withStatus(404); 
    }

    public function conflict(int $status, $body = []): ResponseInterface
    {
        return (new R(['status' => $status, 'body' => $body]))->withStatus(409); 
    }
}
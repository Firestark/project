<?php

use Psr\Http\Message\ResponseInterface;
use  Zend\Diactoros\Response\JsonResponse;
use function compact as with;

Status::matching(1001, function(array $todos): ResponseInterface
{
    return Response::ok(1001, array_values($todos));
});

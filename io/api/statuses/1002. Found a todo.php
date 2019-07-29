<?php

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use function compact as with;

Status::matching (1002, function (todo $todo): ResponseInterface
{
    return Response::ok(1002, $todo);
});

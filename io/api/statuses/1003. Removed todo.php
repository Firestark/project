<?php

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

Status::matching(1003, function (Todo $todo): ResponseInterface
{
    return new JsonResponse(['status' => 1003, 'body' => []]);
});
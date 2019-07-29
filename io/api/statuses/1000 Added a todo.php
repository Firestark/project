<?php

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

Status::matching(1000, function (): ResponseInterface
{
    return Response::ok(1000);
});
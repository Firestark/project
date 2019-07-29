<?php

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

Status::matching(2001, function (): ResponseInterface
{
    return Response::notFound(2001);
});
<?php

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

Status::matching(2000, function (): ResponseInterface
{
	return new JsonResponse(['status' => 2000, 'body' => []]);
});

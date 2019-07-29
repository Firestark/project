<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

Route::get('/{id}', function (ServerRequestInterface $request, array $args): ResponseInterface
{
    list($status, $payload) = App::make('i want to see a todo', $args);
    return App::call(Status::match($status), $payload);
});
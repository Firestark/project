<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

Route::post('/{id}', function (ServerRequestInterface $request): ResponseInterface
{
    list($status, $payload) = App::make('i want to update a todo');
    return App::call(Status::match($status), $payload);
});
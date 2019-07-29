<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

Route::post('/{id}', function (ServerRequestInterface $request): ResponseInterface
{
    $todo = App::make(Todo::class, (array) $request->getParsedBody());
    list($status, $payload) = App::make('i want to update a todo', ['todo' => $todo]);
    return App::call(Status::match($status), $payload);
});
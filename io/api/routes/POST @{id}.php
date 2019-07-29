<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

Route::post('/{id}', function (ServerRequestInterface $request): ResponseInterface
{
    $todo = App::make(Todo::class, (array) json_decode($request->getBody()));
    list($status, $payload) = App::make('i want to update a todo', ['todo' => $todo]);
    return App::call(Status::match($status), $payload);
});
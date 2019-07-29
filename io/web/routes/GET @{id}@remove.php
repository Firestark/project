<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

Route::get('/{id}/remove', function (ServerRequestInterface $request, array $args): ResponseInterface
{
    list($status, $payload) = App::make('i want to remove a todo', $args);
    return App::call(Status::match($status), $payload);
});
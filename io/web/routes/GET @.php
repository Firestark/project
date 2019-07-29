<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

Route::get('/', function (ServerRequestInterface $request): ResponseInterface {
    list($status, $payload) = App::make('i want to see my to-dos');
    return App::call(Status::match($status), $payload);
});
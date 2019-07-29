<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

Route::get('/add', function (ServerRequestInterface $request): ResponseInterface {
    return View::make('todo/add');
});
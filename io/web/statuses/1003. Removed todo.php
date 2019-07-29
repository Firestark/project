<?php

use Psr\Http\Message\ResponseInterface;

Status::matching(1003, function (Todo $todo): ResponseInterface
{
    Session::flash('message', 'Todo removed.');
    return Redirect::to('/');
});
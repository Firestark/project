<?php

use Psr\Http\Message\ResponseInterface;

Status::matching(2000, function (): ResponseInterface
{
	Session::flash('message', 'Todo description already exists.');
    return Redirect::to('/');
});

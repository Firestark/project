<?php

use Psr\Http\Message\ResponseInterface;

Status::matching(1007, function (): ResponseInterface
{
    Session::flash('message', 'Updated todo.');
    return Redirect::to('/');
});
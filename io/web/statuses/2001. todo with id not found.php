<?php

use Psr\Http\Message\ResponseInterface;

Status::matching(2001, function (): ResponseInterface
{
    Session::flash('message', 'Todo not found.');
    return Redirect::back();
});
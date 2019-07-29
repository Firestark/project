<?php

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\RedirectResponse;

Status::matching(1000, function (): ResponseInterface
{
    Session::flash('message', 'Todo added.');
    return Redirect::to('/');   
});
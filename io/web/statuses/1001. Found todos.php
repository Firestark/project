<?php

use Psr\Http\Message\ResponseInterface;
use function compact as with;

Status::matching(1001, function(array $todos): ResponseInterface
{
    return View::make('todo/list', with('todos'));
});

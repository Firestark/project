<?php

use Psr\Http\Message\ResponseInterface;
use function compact as with;

Status::matching (1002, function (todo $todo): ResponseInterface
{
    return View::make('todo/edit', with ('todo'));
});

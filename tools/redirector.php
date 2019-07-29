<?php

namespace Firestark;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Redirector
{
    private $previous = '/';

    public function __construct(string $previous)
    {
        $this->previous = $previous;
    }

    public function to(string $uri): ResponseInterface
    {
        return new RedirectResponse($uri);
    }

    public function back(): ResponseInterface
    {
        return new RedirectResponse($this->previous);
    }
}
<?php

namespace Firestark;

use Psr\Http\Message\ResponseInterface;

class View
{
    private $response = null;
    private $basedir = '';
    
    public function __construct(Response $response, string $basedir)
    {
        $this->response = $response;
        $this->basedir = $basedir;
    }

    public function make(string $view, array $parameters = []): ResponseInterface
    {
        extract($parameters);
        ob_start();
        require $this->basedir . '/' . $view . '.php';
        return $this->response->ok(ob_get_clean());
    }

    public function asString(string $view, array $parameters = []): string
    {
        extract($parameters);
        ob_start();
        require $this->basedir . '/' . $view . '.php';
        return ob_get_clean();
    }
}
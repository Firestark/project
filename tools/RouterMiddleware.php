<?php

namespace Firestark;

use League\Route\Router;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Server\MiddlewareInterface as Middleware;

class RouterMiddleware implements Middleware
{
    private $router = null;
    private $view = '';
    
    public function __construct(Router $router, ResponseFactoryInterface $response, string $view)
    {
        $this->router = $router;
        $this->response = $response;
        $this->view = $view;
    }
    
    public function process(Request $request, Handler $handler): Response
    {
        try {
            return $this->router->dispatch($request);
        } catch(NotFoundException $e) {
            $response = $this->response->createResponse(404);
            $response->getBody()->write($this->view);
            return $response->withHeader('content-type', 'text/html');
        }
    }
}
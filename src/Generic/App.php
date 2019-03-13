<?php

namespace Generic;

use GuzzleHttp\Psr7\Response;
use Appli\Controller\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Generic\Middlewares\TrailingSlashMiddleware;

class App implements RequestHandlerInterface
{

     /**
     * @var int
     */
    private $compteurMiddleware;

    /**
     * @var MiddlewareInterface[]
     */
    private $middlewares;

    public function __construct(array $middlewares)
    {
        // On initialise le compteur de middleware à 0
        $this->compteurMiddleware = 0;
        $this->middlewares = $middlewares;
    }
    
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // On récupère le middleware à appeler
        $middleware = $this->middlewares[$this->compteurMiddleware];
        // Incrémentation du compteur
        $this->compteurMiddleware++;
        // On appelle le middleware
        $response = $middleware->process($request, $this);
        return $response;
    }
}

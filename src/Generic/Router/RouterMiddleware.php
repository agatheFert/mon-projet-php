<?php
namespace Generic\Router;

use Generic\Router\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;



class RouterMiddleware implements MiddlewareInterface
{
    

    private $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    } 

    /**
     * process
     *
     * @param  mixed $request
     * @param  mixed $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        
           // Recuperation du routeur
           $router = new Router;

           // Recuperation de l'eventuel controlleur
           $controller = $this->router->match($request);
           //var_dump($controller);

           if(!is_null($controller)){
               // si il y a un controller -> on appelle sa methode "process"
               $response = $controller->process($request, $handler);

           } else {
                // si il n'y a pas de controller -> on renvoit une page 404
               $response = new Response(404, [], "<h1>PAge 404</h1>" );

           }
           return $response;


    }

}


<?php

namespace Generic\Router;

use Zend\Expressive\Router\Route;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Psr\Http\Message\ServerRequestInterface;

class Router
{


    private $routerVendor;

    public function __construct()
    {
        // pour que les 2 functions addclass et match utilisent la meme propriete il faut la declarer en dehors des 2 fonctions
         $this->routerVendor = new FastRouteRouter();

    }

    
    //Puisqu'on a instancié la class FastRouteRouter(); on se sert de ses 2 fonctions : addclass et match
    //chemin FastRouteRouter() : vendor\zendframework\zend-expressive-fastroute\src\FastRouteRouter.php


    public function addRoute(string $url, MiddlewareInterface $controller, ?string $name = null ): void
    {
        
        // On crée un objet route pour le passer au "vrai" routeur
        // Suivre le constructeur de la class Route : fichier Route.php
        $route = new Route($url, $controller, null, $name);

        // On appelle la fonction du "vrai" routeur pour ajouter une route
        $this->routerVendor->addRoute($route);
    }


    public function match(ServerRequestInterface $request): ?Middlewareinterface
    {
       
        $result = $this->routerVendor->match($request);

        if($result->isSuccess()) {
            
            $route = $result->getMatchedRoute()->getMiddleware();

        } else {
            $route = null;
        }

        return $route;
    }



    
}
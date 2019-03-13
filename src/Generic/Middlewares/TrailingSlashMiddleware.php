<?php

namespace Generic\Middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
    
      // Trouver l'url
        $url = $request->getUri()->getPath();


       // Determiner le dernier caractere de l'url
        $lastCharacter = substr($url, -1);


       // Si le dernier caratere est un slash /
        if ($lastCharacter === '/') {
            // Determier la new url : substr($url, 0, -1) demarre de 0 et va jusqu'a la fin -1
            $newURL = substr($url, 0, -1);
            var_dump("nouvelle url : " . $newURL);


            // Rediriger
            $response = new Response(301, [
            'location' => $newURL
            ]);
            return $response;
        } else {
        // Sinon on appelle le middleware suivant
            return $handler->handle($request);
        }




        var_dump("Ancienne : " . $url);
        die("On est dans TrailingSlashMiddleware");
    }
}

<?php

namespace Appli\Controller;

use GuzzleHttp\Psr7\Response;
use Generic\Controller\Controller;
use Appli\Controller\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ContactController extends Controller 
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        //return new Response(200, [], "<h1>Bonjour tout le monde ! Contact</h1>");
        return $this->render('contact.twig');
    }
}

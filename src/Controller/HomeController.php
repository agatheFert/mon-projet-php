<?php

namespace Appli\Controller;

use GuzzleHttp\Psr7\Response;
use Generic\Controller\Controller;
use Appli\Controller\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomeController extends Controller
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {


        $products = [
            [
                "id" => 1,
                "name" => "Hamac",
                "description" => "Pour se reposer"
            ],
            [
                "id" => 2,
                "name" => "Parasol",
                "description" => "Pour faire de l'ombre"
            ]
        ];



        // return new Response(200, [], "<h1>Bonjour tout le monde !</h1>");
        return $this->render('home.twig', [
               'products' => $products,
               'title' => "BONJOUR !!"

        ]);
    }
}

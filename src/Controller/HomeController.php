<?php

namespace Appli\Controller;

use GuzzleHttp\Psr7\Response;

use Generic\Database\Connection;

use Generic\Controller\Controller;
use Generic\Renderer\TwigRenderer;
use Appli\Controller\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomeController extends Controller
{
    
    private $connection ;
    public function __construct(TwigRenderer $twig, Connection $connection)
    {

        parent::__construct($twig);

        $this->connection = $connection;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

         //recuperation des produits en BDD
        $products = $this->connection->query("SELECT * FROM product");



        // return new Response(200, [], "<h1>Bonjour tout le monde !</h1>");
        return $this->render('home.twig', [
               'products' => $products,
               'title' => "BONJOUR !!!"

        ]);
    }
}

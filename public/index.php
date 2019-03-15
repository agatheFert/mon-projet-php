<?php

use Generic\App;
use Generic\Router\Router;
use GuzzleHttp\Psr7\Response;

use Generic\Renderer\TwigRenderer;
use GuzzleHttp\Psr7\ServerRequest;
use Appli\Controller\HomeController;
use Generic\Router\RouterMiddleware;
use Appli\Controller\ContactController;
use Generic\Middlewares\TrailingSlashMiddleware;

$rootDir = dirname(__DIR__);

// chargement de l'autoloader
require_once dirname(__DIR__, 1) ."/vendor/autoload.php";

// Creation du conteneur
$builder = new DI\ContainerBuilder();
$builder->addDefinitions($rootDir.'/config/config.php');
$container = $builder->build();

// Creation de la requete
// ::fromGlobals();   :: signifie statique
$request = ServerRequest::fromGlobals();

// Initialiser Twig
$twig = new TwigRenderer($rootDir.'/templates');

// Ajout des routes dans le routeur
$router = $container->get(Router::class);
$router->addRoute('/', $container->get(HomeController::class), 'homepage');
$router->addRoute('/contact', $container->get(ContactController::class), 'contact');




// Creation de la reponse : on instancie notre class APP
$app = new App([
    $container->get(TrailingSlashMiddleware::class),
    $container->get(RouterMiddleware::class)
]);

//$response = new Response(200, [], "<h1>Bonjour  !</h1>");

// Appel de la methode  handle de l'objet App
$response = $app->handle($request);


//Renvoi de la reponse au navigateur
\Http\Response\send($response);

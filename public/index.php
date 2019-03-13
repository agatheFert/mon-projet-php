<?php

use Generic\App;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Appli\Controller\HomeController;
use Generic\Middlewares\TrailingSlashMiddleware;

// chargement de l'autoloader
require_once dirname(__DIR__, 1) ."/vendor/autoload.php";


// Creation de la requete
// ::fromGlobals();   :: signifie statique
$request = ServerRequest::fromGlobals();


// Creation de la reponse
$app = new App([
    new TrailingSlashMiddleware(),
    new HomeController()
]);
//$response = new Response(200, [], "<h1>Bonjour  !</h1>");

// Appel de la methode  handle de l'objet App
$response = $app->handle($request);


//Renvoi de la reponse au navigateur
\Http\Response\send($response);

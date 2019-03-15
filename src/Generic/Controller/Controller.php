<?php

namespace  Generic\Controller;

use GuzzleHttp\Psr7\Response;
use Generic\Renderer\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

abstract class Controller implements MiddlewareInterface
{


    private $twig;

    public function __construct(TwigRenderer $twig)
    {

        $this->twig =$twig;
    }

    protected function render(string $view, array $variables = []): ResponseInterface
    {

        return new Response(200, [], $this->twig->render($view, $variables));
    }
}

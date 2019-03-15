<?php

namespace Generic\Renderer;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;



class TwigRenderer
{    

    private $twig;

    public function __construct($path)
    {
     
        $loader = new \Twig\Loader\FilesystemLoader($path);
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false
        ]);


    }


    public function render(string $view, array $variables = []): string
    {

        return $this->twig->render($view, $variables);

    }
}           
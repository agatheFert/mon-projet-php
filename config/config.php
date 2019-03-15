<?php

use Generic\Database\Connection;
use Generic\Renderer\TwigRenderer;

return [

    "root-dir"  => dirname(__DIR__),
    "database_name" => "bdd_mysql_command",
    "database_user" => "php_pdo_agathe",
    "database_pass" => "rhFWM1VGj0qy88P9",

    TwigRenderer::class => function(\DI\Container $container) {
       return new TwigRenderer(dirname(__DIR__) . "/templates");

    },

    Connection::class => function (\DI\Container $container) {
        return new Connection(
            $container->get('database_name'),
            $container->get('database_user'),
            $container->get('database_pass')
        );
    }


];






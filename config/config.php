<?php

use Generic\Renderer\TwigRenderer;

return [

    "root-dir"  => dirname(__DIR__),
    "database_name" => "bdd_mysql_command",
    "database_user" => "php_pdo_agathe",
    "database_pass" => "rhFWM1VGj0qy88P9",

    TwigRenderer::class => function(){
       return new TwigRenderer(dirname(__DIR__) . "/templates");

    }


];






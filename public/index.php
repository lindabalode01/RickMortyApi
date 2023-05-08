<?php
require_once "../vendor/autoload.php";

$response = \RickMortyApi\Core\Router::router();
$twig = new \RickMortyApi\Core\TwigRender();

echo $twig->render($response);






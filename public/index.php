<?php
require_once "../vendor/autoload.php";

use RickMortyApi\ApiClient;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$n = new ApiClient();
$characters = $n->fetchCharacters();

$loader = new FilesystemLoader(__DIR__.'/../app/Views');
$twig = new Environment($loader);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [\RickMortyApi\Controller\CharacterController::class, 'index']);
    $r->addRoute('GET', '/characters/{id:\d+}', [\RickMortyApi\Controller\CharacterController::class, 'index']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        break;
}

try {
    echo $twig->render('characters.html.twig', ['characters' => $characters]);
} catch (\Twig\Error\LoaderError|\Twig\Error\RuntimeError|\Twig\Error\SyntaxError $e) {
}

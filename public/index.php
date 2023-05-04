<?php
require_once "../vendor/autoload.php";

use RickMortyApi\Models\ApiClient;


$n = new ApiClient();
$characters = $n->fetchCharacters();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

echo $twig->render('template.html.twig', ['characters' => $characters]);
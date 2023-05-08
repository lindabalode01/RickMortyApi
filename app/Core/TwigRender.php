<?php

namespace RickMortyApi\Core;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class TwigRender
{
private Environment $twig;
public function __construct()
{
    $loader = new FilesystemLoader('../app/Views');
    $this->twig = new Environment($loader);
}

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function render(View $view):string
{
    return $this->twig->render($view->getPath(), ['characters'=>$view->getCharacters()]);
}
}
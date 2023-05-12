<?php

namespace RickMortyApi\Core;

use RickMortyApi\Core\View;
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

    public function render(View $view): string
    {
        try {
            return $this->twig->render($view->getPath(), ['characters' => $view->getCharacters()]);

        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            return $e->getMessage();
        }
    }
}
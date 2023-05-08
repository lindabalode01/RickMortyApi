<?php

namespace RickMortyApi\Core;

class View
{
private array $characters;
private string $path;
public function __construct(string $path, array $characters)
{
    $this->characters = $characters;
    $this->path = $path;
}
public function getPath():string
{
    return $this->path.'.html.twig';
}
public function getCharacters():array
{
    return $this->characters;
}
}
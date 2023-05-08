<?php

namespace RickMortyApi\Controller;

use RickMortyApi\ApiClient;
use RickMortyApi\Core\View;

class CharacterController
{
    private ApiClient $client;
    public function __construct()
    {
        $this->client = new ApiClient();
    }
public function index(): View
{
    return new View('characters',
        $this->client->fetchCharacters());
}
}
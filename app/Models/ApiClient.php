<?php
namespace RickMortyApi\Models;
use GuzzleHttp\Client;

class ApiClient
{

private Client $client;
private const URL = 'https://rickandmortyapi.com/api/character/?page=6';
public function __construct()
{
    $this->client = new Client();
}
    public function fetchCharacters(): array
{
    $characterCollection = [];
    $response = $this->client->get(self::URL);
    $characters = json_decode($response->getBody()->getContents());
    foreach ($characters->results as $character)
    {
        $characterCollection[] = new RickMorty
        (
            $character->name,
            $character->status,
            $character->species,
            $character->location->name,
            json_decode($this->client->get($character->episode[0])->getBody()->getContents())->name,
            $character->image
        );
    }
    return $characterCollection;
}
}
$n = new ApiClient();
    $n->fetchCharacters();
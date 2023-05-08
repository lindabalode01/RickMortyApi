<?php

namespace RickMortyApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RickMortyApi\Models\Character;
use RickMortyApi\Models\Episode;

class ApiClient
{

    private Client $client;
    private const URL = "https://rickandmortyapi.com/api/character/?page=9";

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchCharacters(): array
    {
        $characterCollection = [];
        $response = $this->client->get(self::URL);
        $characters = json_decode($response->getBody()->getContents());
        foreach ($characters->results as $character) {
            $episode = json_decode($this->client->get($character->episode[0])->getBody()->getContents());
                $characterCollection[] = new Character
                (
                    $character->name,
                    $character->status,
                    $character->species,
                    $character->location->name,
                    new Episode($episode->name),
                    $character->image
                );
            }
        return $characterCollection;

    }


}

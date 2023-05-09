<?php

namespace RickMortyApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RickMortyApi\Models\Character;
use RickMortyApi\Models\Episode;

class ApiClient
{

    private Client $client;
    private const URL = "https://rickandmortyapi.com/api/character/?page=8";

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchCharacters(): array
    {
        try {
            $characterCollection = [];
            if (!Cache::ifHas('characters')) {
                $response = $this->client->get(self::URL);
                $responseJson = $response->getBody()->getContents();
                Cache::save('characters', $responseJson, 120);
            } else {
                $responseJson = Cache::get('characters');
            }
            $characters = json_decode($responseJson);
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
        } catch (GuzzleException $e) {
            return [];
        }

    }


}

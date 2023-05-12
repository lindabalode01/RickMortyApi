<?php

namespace RickMortyApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RickMortyApi\Models\Character;
use RickMortyApi\Models\Episode;

class ApiClient
{

    private Client $client;
    private const URL = "https://rickandmortyapi.com/api/character/";

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchCharacters(): array
    {
        try {
            if (!Cache::ifHas('characters')) {
                $response = $this->client->get(self::URL);
                $responseJson = $response->getBody()->getContents();
                Cache::save('characters', $responseJson, 120);
            } else {
                $responseJson = Cache::get('characters');
            }
            $characters = json_decode($responseJson);

            return $this->createCollection($characters->results);
        } catch (GuzzleException $e) {
            return [];
        }

    }

    public function searchCharacters(string $name, string $status): array
    {
        try {
            if (!Cache::ifHas('found_characters')) {
                $response = $this->client->get(self::URL, [
                        'query' => [
                            'name' => $name,
                            'status' => $status]
                    ]
                );
                $responseJson = $response->getBody()->getContents();
                Cache::save('found_characters', $responseJson, 120);
            } else {
                $responseJson = Cache::get('found_characters');
            }
            $characters = json_decode($responseJson);

            return $this->createCollection($characters->results);
        } catch (GuzzleException $exception) {
            return [];
        }
    }

    public function createCollection(array $characters): array
    {
        $collection = [];
        foreach ($characters as $character) {
            $episode = json_decode($this->client->get($character->episode[0])->getBody()->getContents());
            $collection[] = new Character
            (
                $character->name,
                $character->status,
                $character->species,
                $character->location->name,
                new Episode($episode->name),
                $character->image
            );
        }
        return $collection;
    }
}

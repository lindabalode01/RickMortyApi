<?php

namespace RickMortyApi\Models;

class Character
{
    private string $name;
    private string $status;
    private string $species;
    private string $location;
    private string $firstSceen;
    private string $pictureUrl;

    public function __construct
    (
        string $name,
        string $status,
        string $species,
        string $location,
        string $firstSceen,
        string $pictureUrl
    )
    {
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->location = $location;
        $this->firstSceen = $firstSceen;
        $this->pictureUrl = $pictureUrl;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getFirstSceen(): string
    {
        return $this->firstSceen;
    }

    public function getPictureUrl(): string
    {
        return $this->pictureUrl;
    }
}
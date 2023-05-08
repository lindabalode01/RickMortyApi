<?php

namespace RickMortyApi\Models;

class Character
{
    private string $name;
    private string $status;
    private string $species;
    private string $location;
    private Episode $firstSceen;
    private string $pictureUrl;

    public function __construct
    (
        string  $name,
        string  $status,
        string  $species,
        string  $location,
        Episode $firstSceen,
        string  $pictureUrl
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

    public function getFirstSceen(): Episode
    {
        return $this->firstSceen;
    }

    public function getPictureUrl(): string
    {
        return $this->pictureUrl;
    }
}
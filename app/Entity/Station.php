<?php

namespace Entity;

class Station
{

    private int $station_id;
    private int $stationCode;
    private string $name;
    private float $lat;
    private float $lon;
    private int $capacity;

    public function getStationId(): int
    {
        return $this->station_id;
    }

    public function setStationId(int $station_id): Station
    {
        $this->station_id = $station_id;
        return $this;
    }

    public function getStationCode(): int
    {
        return $this->stationCode;
    }

    public function setStationCode(int $stationCode): Station
    {
        $this->stationCode = $stationCode;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Station
    {
        $this->name = $name;
        return $this;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function setLat(float $lat): Station
    {
        $this->lat = $lat;
        return $this;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function setLon(float $lon): Station
    {
        $this->lon = $lon;
        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): Station
    {
        $this->capacity = $capacity;
        return $this;
    }
}
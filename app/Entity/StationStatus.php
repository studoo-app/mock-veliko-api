<?php

namespace Entity;

use Entity\Station;

class StationStatus extends Station
{
    /**
     * @var int
     */
    private int $num_bikes_available;

    /**
     * @var array
     */
    private array $num_bikes_available_types;

    /**
     * @var array
     */
    private int $num_docks_available;

    /**
     * @var int
     */
    private int $is_installed;

    /**
     * @var int
     */
    private int $is_returning;

    /**
     * @var int
     */
    private int $is_renting;

    /**
     * @var int
     */
    private int $last_reported;

    public function __construct(int $station_id, int $stationCode)
    {
        parent::setStationId($station_id);
        parent::setStationCode($stationCode);
    }

    /**
     * @return int
     */
    public function getNumBikesAvailable(): int
    {
        return $this->num_bikes_available;
    }

    /**
     * @param int $num_bikes_available
     * @return StationStatus
     */
    public function setNumBikesAvailable(int $num_bikes_available): StationStatus
    {
        $this->num_bikes_available = $num_bikes_available;
        return $this;
    }

    /**
     * @return array
     */
    public function getNumBikesAvailableTypes(): array
    {
        return $this->num_bikes_available_types;
    }

    /**
     * @param array $num_bikes_available_types
     * @return StationStatus
     */
    public function setNumBikesAvailableTypes(array $num_bikes_available_types): StationStatus
    {
        $this->num_bikes_available_types = $num_bikes_available_types;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumDocksAvailable(): int
    {
        return $this->num_docks_available;
    }

    /**
     * @param int $num_docks_available
     * @return StationStatus
     */
    public function setNumDocksAvailable(int $num_docks_available): StationStatus
    {
        $this->num_docks_available = $num_docks_available;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsInstalled(): int
    {
        return $this->is_installed;
    }

    /**
     * @param int $is_installed
     * @return StationStatus
     */
    public function setIsInstalled(int $is_installed): StationStatus
    {
        $this->is_installed = $is_installed;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsReturning(): int
    {
        return $this->is_returning;
    }

    /**
     * @param int $is_returning
     * @return StationStatus
     */
    public function setIsReturning(int $is_returning): StationStatus
    {
        $this->is_returning = $is_returning;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsRenting(): int
    {
        return $this->is_renting;
    }

    /**
     * @param int $is_renting
     * @return StationStatus
     */
    public function setIsRenting(int $is_renting): StationStatus
    {
        $this->is_renting = $is_renting;
        return $this;
    }

    /**
     * @return int
     */
    public function getLastReported(): int
    {
        return $this->last_reported;
    }

    /**
     * @param int $last_reported
     * @return StationStatus
     */
    public function setLastReported(int $last_reported): StationStatus
    {
        $this->last_reported = $last_reported;
        return $this;
    }
}
<?php

namespace Repository;

use PDO;
use Studoo\EduFramework\Core\Service\DatabaseSqlite;

class StationRepository
{
    private PDO $db;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->db = (new DatabaseSqlite())->getManager();
    }

    /**
     * Inserer une Station
     *
     * @param array $item
     * @return void
     */
    public function insert(array $item): void
    {
        $stmt = $this->db->prepare('INSERT INTO Station (station_id, stationCode, name, lat, lon, capacity) VALUES (:station_id, :stationCode, :name, :lat, :lon, :capacity)');

        $stmt->execute([
            ':station_id' => $item['station_id'],
            ':stationCode' => $item['stationCode'],
            ':name' => $item['name'],
            ':lat' => $item['lat'],
            ':lon' => $item['lon'],
            ':capacity' => $item['capacity']
        ]);
    }

    /**
     * Récupérer toutes les stations
     *
     * @return array
     */
    public function getAllStations(): array|bool
    {
        $stmt = $this->db->prepare('SELECT * FROM station');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneStation(int $id): array|bool
    {
        $stmt = $this->db->prepare('SELECT * FROM station WHERE station_id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOneStationStatus(int $id): array|bool
    {
        $stmt = $this->db->prepare('SELECT * FROM station, station_status WHERE station.station_id = :id AND station.station_id = station_status.station_id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Vider la table `Station`
     */
    public function truncateTable(): void
    {
        $stmt = $this->db->prepare('DELETE FROM Station WHERE 1=1');
        $stmt->execute();
    }
}


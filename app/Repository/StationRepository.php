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
     * Inserer une station
     *
     * @param array $item
     * @return void
     */
    public function insert(array $item): void
    {
        $stmt = $this->db->prepare('INSERT INTO station (station_id, stationCode, name, lat, lon, capacity) VALUES (:station_id, :stationCode, :name, :lat, :lon, :capacity)');

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
     * Vider la table `station`
     */
    public function truncateTable(): void
    {
        $stmt = $this->db->prepare('DELETE FROM station WHERE 1=1');
        $stmt->execute();
    }
}
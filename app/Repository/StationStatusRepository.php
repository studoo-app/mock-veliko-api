<?php

namespace Repository;

use PDO;
use Studoo\EduFramework\Core\Service\DatabaseSqlite;

class StationStatusRepository
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
     * Inserer un status de station
     *
     * @param array $item
     * @return void
     */
    public function insert(array $item): void
    {
        $stmt = $this->db->prepare('INSERT INTO station_status (station_id, num_bikes_available, num_bikes_available_types, num_docks_available, is_installed, is_returning, is_renting, last_reported) VALUES (:station_id, :num_bikes_available, :num_bikes_available_types, :num_docks_available, :is_installed, :is_returning, :is_renting, :last_reported)');

        $stmt->execute([
            ':station_id' => $item['station_id'],
            ':num_bikes_available' => $item['num_bikes_available'],
            ':num_bikes_available_types' => json_encode($item['num_bikes_available_types']),
            ':num_docks_available' => $item['num_docks_available'],
            ':is_installed' => $item['is_installed'],
            ':is_returning' => $item['is_returning'],
            ':is_renting' => $item['is_renting'],
            ':last_reported' => $item['last_reported']
        ]);
    }

    /**
     * Mettre à jour un status de station par son id
     *
     * @param array $item
     * @return void
     */
    public function update(array $item): void
    {
        $stmt = $this->db->prepare('UPDATE station_status SET num_bikes_available = :num_bikes_available, num_bikes_available_types = :num_bikes_available_types, num_docks_available = :num_docks_available, last_reported = :last_reported WHERE station_id = :station_id');

        $stmt->execute([
            ':station_id' => $item['station_id'],
            ':num_bikes_available' => $item['num_bikes_available'],
            ':num_bikes_available_types' => json_encode($item['num_bikes_available_types']),
            ':num_docks_available' => $item['num_docks_available'],
            ':last_reported' => $item['last_reported']
        ]);
    }

    /**
     * Récupérer un status de station par son id
     *
     * @param int $stationId
     * @return array
     */
    public function getStationsStatusById(int $stationId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM station_status WHERE station_id = :station_id');
        $stmt->execute([':station_id' => $stationId]);
        $station = $stmt->fetch(PDO::FETCH_ASSOC);
        $station['num_bikes_available_types'] = json_decode($station['num_bikes_available_types'], true);
        return $station;
    }

    /**
     * Récupérer toutes les status des stations
     *
     * @return array
     */
    public function getAllStationsStatus(): array|bool
    {
        $stmt = $this->db->prepare('SELECT * FROM station_status');
        $stmt->execute();
        $station = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($station === false) {
            return false;
        }
        foreach ($station as $key => $value) {
            $station[$key]['num_bikes_available_types'] = json_decode($value['num_bikes_available_types'], true);
        }
        return $station;
    }

    /**
     * Vider la table `station_status`
     */
    public function truncateTable(): void
    {
        $stmt = $this->db->prepare('DELETE FROM station_status WHERE 1=1');
        $stmt->execute();
    }
}
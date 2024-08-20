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
     * Récupérer toutes les status des stations
     *
     * @return array
     */
    public function getAllStationsStatus(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM station_status');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
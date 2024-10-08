<?php

namespace Repository;

use PDO;
use Studoo\EduFramework\Core\Service\DatabaseSqlite;

class VeloRepository
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
     * Inserer un velo
     *
     * @param array $item
     * @return void
     */
    public function insert(array $item): void
    {
        $stmt = $this->db->prepare('INSERT INTO Velo (type, status, num_km_total, station_id_available) VALUES (:type, :status, :num_km_total, :station_id_available)');

        $stmt->execute([
            ':type' => $item['type'],
            ':status' => $item['status'],
            ':num_km_total' => $item['num_km_total'],
            ':station_id_available' => $item['station_id_available']
        ]);
    }

    /**
     * Mettre à jour un velo par son id
     *
     * @param array $item
     * @return void
     */
    public function update(array $item): void
    {
        $stmt = $this->db->prepare('UPDATE Velo SET status = :status, num_km_total = :num_km_total, station_id_available = :station_id_available WHERE velo_id = :velo_id');

        $stmt->execute([
            ':velo_id' => $item['velo_id'],
            ':status' => $item['status'],
            ':num_km_total' => $item['num_km_total'],
            ':station_id_available' => $item['station_id_available']
        ]);
    }

    /**
     * Récupérer tous les velos
     * @return array
     */
    public function getAllVelo(): array|bool
    {
        $stmt = $this->db->prepare('SELECT * FROM velo');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Récupérer le velo par son id
     * @param int $id
     * @return array
     */
    public function getVeloById(int $velo_id): array|bool
    {
        $stmt = $this->db->prepare('SELECT * FROM velo WHERE velo_id = :velo_id');
        $stmt->execute([
            ':velo_id' => $velo_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer tous les velos
     * @return array
     */
    public function getVeloByStation(int $station_id): array|bool
    {
        $stmt = $this->db->prepare('SELECT * FROM velo WHERE station_id_available = :station_id_available');
        $stmt->execute([
            ':station_id_available' => $station_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Vider la table `velo`
     */
    public function truncateTable(): void
    {
        $stmt = $this->db->prepare('DELETE FROM Velo WHERE 1=1');
        $stmt->execute();
    }
}


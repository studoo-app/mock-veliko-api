<?php

namespace Controller\api;

use Repository\StationRepository;
use Repository\StationStatusRepository;
use Repository\VeloRepository;
use Studoo\EduFramework\Core\Service\DatabaseSqlite;

class    InitApi
{
    public function getStructure(): array
    {
        $sql01Station = file_get_contents(__DIR__ . '/../../sql/01.station.sql');
        $sql02StationStatus = file_get_contents(__DIR__ . '/../../sql/02.station.status.sql');
        $sql03Velo = file_get_contents(__DIR__ . '/../../sql/03.velo.sql');

        $db = (new DatabaseSqlite())->getManager();
        $db->exec($sql01Station);
        $db->exec($sql02StationStatus);
        $db->exec($sql03Velo);

        return [
            "status" => "success",
            "message" => "Structure API VELIKO is done"
        ];
    }

    public function getData(): array
    {
        (new StationRepository())->truncateTable();
        (new StationStatusRepository())->truncateTable();
        (new VeloRepository())->truncateTable();

        // Fetch data on station_information
        $apiUrlStation = 'https://velib-metropole-opendata.smovengo.cloud/opendata/Velib_Metropole/station_information.json';
        $jsonDataStation = file_get_contents($apiUrlStation);
        if ($jsonDataStation === false) {
            new \Exception("Error fetching data from API VELIB (station_information.json)");
        }
        $dataStation = json_decode($jsonDataStation, true);

        foreach ($dataStation["data"]["stations"] as $item) {
            (new StationRepository())->insert($item);
        }

        // Fetch data on station_status
        $apiUrlStatus = 'https://velib-metropole-opendata.smovengo.cloud/opendata/Velib_Metropole/station_status.json';
        $jsonDataStatus = file_get_contents($apiUrlStatus);
        if ($jsonDataStatus === false) {
            new \Exception("Error fetching data from API VELIB (station_status.json)");
        }
        $dataStatus = json_decode($jsonDataStatus, true);

        foreach ($dataStatus["data"]["stations"] as $item) {
            (new StationStatusRepository())->insert($item);
            if (is_array($item["num_bikes_available_types"])) {
                foreach ($item["num_bikes_available_types"] as $itemAvailable) {
                    foreach ($itemAvailable as $type => $nbBikeAvailable) {
                        for ($i = 0; $i < $nbBikeAvailable; $i++) {
                            (new VeloRepository())->insert([
                                "type" => $type,
                                "status" => "available",
                                "num_km_total" => random_int(0, 1000),
                                "station_id_available" => $item["station_id"]
                            ]);
                        }
                    }
                }
            }
        }

        return [
            "status" => "success",
            "message" => "API VELIKO is running"
        ];
    }
}
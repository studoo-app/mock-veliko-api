<?php

namespace Controller\api;

use OpenApi\Attributes;
use Repository\StationRepository;
use Repository\StationStatusRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class InitController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/init')]
	#[Attributes\Response(response: '200', description: 'Initialisation de l\'API VELIKO')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        (new StationRepository())->truncateTable();
        (new StationStatusRepository())->truncateTable();

        // Fetch data on station_information
        $apiUrlStation = 'https://velib-metropole-opendata.smovengo.cloud/opendata/Velib_Metropole/station_information.json';
        $jsonDataStation = file_get_contents($apiUrlStation);
        $dataStation = json_decode($jsonDataStation, true);

        foreach ($dataStation["data"]["stations"] as $item) {
            (new StationRepository())->insert($item);
        }

        // Fetch data on station_status
        $apiUrlStatus = 'https://velib-metropole-opendata.smovengo.cloud/opendata/Velib_Metropole/station_status.json';
        $jsonDataStatus = file_get_contents($apiUrlStatus);
        $dataStatus = json_decode($jsonDataStatus, true);

        foreach ($dataStatus["data"]["stations"] as $item) {
            (new StationStatusRepository())->insert($item);
        }

        $listTest = [
            "status" => "success",
            "message" => "API VELIKO is running"
        ];

		return json_encode($listTest);
	}
}

<?php

namespace Controller\api;

use OpenApi\Attributes;
use Repository\StationRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class InitController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/init')]
	#[Attributes\Response(response: '200', description: 'Initialisation de l\'API VELIKO')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        // Fetch data from API
        $apiUrl = 'https://velib-metropole-opendata.smovengo.cloud/opendata/Velib_Metropole/station_information.json';
        $jsonData = file_get_contents($apiUrl);
        $data = json_decode($jsonData, true);

        foreach ($data["data"]["stations"] as $item) {
            (new StationRepository())->insert($item);
        }

        $listTest = [
            "status" => "success",
            "message" => "API VELIKO is running"
        ];

		return json_encode($listTest);
	}
}

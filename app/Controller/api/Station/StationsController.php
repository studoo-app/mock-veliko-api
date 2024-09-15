<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationsController implements ControllerInterface
{
	#[Attributes\Get(
        path: '/api/stations',
        tags: ['station'],
        operationId: 'getStations',
        description: 'Récupérer une liste des informations des stations<br>
        La description des champs:<br>
        - station_id: ID de la station<br>
        - stationCode: Code de la station<br>
        - name: Nom de la station<br>
        - lat: Latitude de la station<br>
        - lon: Longitude de la station<br>
        - capacity: Capacité de la station<br>
        '
    )]
    #[Attributes\Response(
        response: '200',
        description: 'Liste des informations des stations sont transmises',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/stations',
                    summary: '/api/stations',
                    value: [
                        [
                            'station_id' => 213688169,
                            'stationCode' => '16107',
                            'name' => 'Benjamin Godard - Victor Hugo',
                            'lat' => 48.865983,
                            'lon' => 2.275725,
                            'capacity' => 35
                        ],
                        [
                            'station_id' => 36255,
                            'stationCode' => '9020',
                            'name' => 'Toudouze - Clauzel',
                            'lat' => 48.879295917335,
                            'lon' => 2.3373600840569,
                            'capacity' => 21
                        ]
                    ]
                )
            ]
        )
    )]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationRepository())->getAllStations();
        if ($data === false) { return json_encode("Station not found"); }

		return json_encode($data);
	}
}

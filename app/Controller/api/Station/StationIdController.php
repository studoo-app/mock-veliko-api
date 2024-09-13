<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationIdController implements ControllerInterface
{
	#[Attributes\Get(
        path: '/api/station/{id}',
        operationId: 'getStationById',
        description: 'Récupérer les informations d une station par son ID (station_id)<br>
        La description des champs:<br>
        - station_id: ID de la station<br>
        - stationCode: Code de la station<br>
        - name: Nom de la station<br>
        - lat: Latitude de la station<br>
        - lon: Longitude de la station<br>
        - capacity: Capacité de la station<br>
        '
    )]
    #[Attributes\Parameter(
        name: 'id',
        description: 'ID de la station',
        in: 'path',
        required: true,
        schema: new Attributes\Schema(type: 'integer')
    )]
	#[Attributes\Response(
        response: '200',
        description: 'Liste d\'une station est transmise avec succès',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/station/213688169',
                    summary: '/api/station/213688169',
                    value: [
                        'station_id' => 213688169,
                        'stationCode' => '16107',
                        'name' => 'Benjamin Godard - Victor Hugo',
                        'lat' => 48.865983,
                        'lon' => 2.275725,
                        'capacity' => 35
                    ]
                )
            ]
        )
    )]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationRepository())->getOneStation($request->get('id'));
        if ($data === false) { return json_encode("Station not found"); }

		return json_encode($data);
	}
}

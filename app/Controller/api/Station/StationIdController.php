<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationIdController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/station/{id}')]
    #[Attributes\Parameter(name: 'id', in: 'path', required: true, schema: new Attributes\Schema(type: 'integer'))]
    #[Attributes\Link(
        link: 'stations',
        operationId: 'getStations',
        parameters: [
            'id' => '$response.body#/station_id'
        ]
    )]
	#[Attributes\Response(
        response: '200',
        description: 'Liste d\'une station',
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

		return json_encode($data);
	}
}

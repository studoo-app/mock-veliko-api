<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationsController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/Stations')]
	#[Attributes\Response(response: '200', description: 'Liste des stations')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationRepository())->getAllStations();

		return json_encode($data);
	}
}

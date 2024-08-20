<?php

namespace Controller\api\Status;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationsStatusController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/stations/status')]
	#[Attributes\Response(response: '200', description: 'Liste des status des stations')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationStatusRepository())->getAllStationsStatus();

		return json_encode($data);
	}
}

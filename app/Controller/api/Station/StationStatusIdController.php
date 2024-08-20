<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationStatusIdController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/station/{id}/status')]
	#[Attributes\Response(response: '200', description: 'Status d une station')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationRepository())->getOneStationStatus($request->get('id'));

		return json_encode($data);
	}
}

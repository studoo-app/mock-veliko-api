<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationIdController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/station/{id}')]
    #[Attributes\Parameter(name: 'id', in: 'path', required: true, schema: new Attributes\Schema(type: 'integer'))]
	#[Attributes\Response(response: '200', description: 'Liste d une station')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationRepository())->getOneStation($request->get('id'));

		return json_encode($data);
	}
}

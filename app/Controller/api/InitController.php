<?php

namespace Controller\api;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class InitController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/init')]
	#[Attributes\Response(response: '200', description: 'Initialisation de l\'API VELIKO')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        // TODO Initialisation de l'API VELIKO

        $listTest = [
            "status" => "success",
            "message" => "API VELIKO is running"
        ];

		return json_encode($listTest);
	}
}

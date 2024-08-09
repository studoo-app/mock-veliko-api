<?php

namespace Controller\api;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class InitController implements ControllerInterface
{
	#[Attributes\Get(path: '/api/init')]
	#[Attributes\Response(response: '200', description: 'Mettre une description')]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

		$listTest = [
		    0 => ["nom" => "Yohaio", "prenom" => "Benoit"],
		    1 => ["nom" => "Toma", "prenom" => "Yann"]
		];

		return json_encode($listTest);
	}
}

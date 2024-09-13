<?php

namespace Controller\api\Velo;

use Core\AuthApi;
use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class VeloLocByIdController implements ControllerInterface
{
	#[Attributes\Put(
        path: '/api/velo/{id}/location',
        operationId: 'getVeloLocById',
        summary: 'getVeloLocById',
        description: 'Location du vélo via son ID, Cette méthode permet de retirer le Vélo de la station',
    )]
    #[Attributes\Parameter(
        name: 'id',
        description: 'ID du vélo',
        in: 'path',
        required: true,
        schema: new Attributes\Schema(type: 'integer')
    )]
	#[Attributes\Response(
        response: '200',
        description: 'L information du vélos sont transmis',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/velo/245671/location',
                    summary: '/api/velo/245671/location',
                    value: [
                            "velo_id" => 245671,
                            "type" => "mechanical",
                            "status" => "location",
                            "num_km_total" => 234,
                            "station_id_available" => 17278902806,
                    ]
                )
            ]
        )
    )]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        if (AuthApi::checkToken($request) === false) { return json_encode("Token is not valid"); }

        $Velo = (new \Repository\VeloRepository())->getVeloById($request->get('id'));
        $Velo["status"] = "location";
        (new \Repository\VeloRepository())->update($Velo);

        return json_encode($Velo);
	}
}

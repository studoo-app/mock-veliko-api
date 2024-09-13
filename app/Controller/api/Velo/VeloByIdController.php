<?php

namespace Controller\api\Velo;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class VeloByIdController implements ControllerInterface
{
	#[Attributes\Get(
        path: '/api/velo/{id}',
        operationId: 'getVeloById',
        summary: 'getVeloById',
        description: 'Information du vélos, voici la structure de données
        <ul>
            <li>velo_id : numéro unique d’identification du vélo.</li>
            <li>type : variable texte indiquant si le vélo est : mécanique ("mechanical") ou électrique ("ebike")</li>
            <li>status : variable texte indiquant si le vélo est : opérationnel ("available"), en anomalie ("fail") ou en cours de réparation ("repair")</li>
            <li>num_km_total : Nombre de kilometre</li>
            <li>station_id_available : ID station rattaché en moment et au départ</li>
        </ul>',
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
                    example: '/api/velo/245671',
                    summary: '/api/velo/245671',
                    value: [
                            "velo_id" => 245671,
                            "type" => "mechanical",
                            "status" => "available",
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

        $data = (new \Repository\VeloRepository())->getVeloById($request->get('id'));
        if ($data === false) { return json_encode("Velo not found"); }

        return json_encode($data);
	}
}

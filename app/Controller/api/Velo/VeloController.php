<?php

namespace Controller\api\Velo;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class VeloController implements ControllerInterface
{
	#[Attributes\Get(
        path: '/api/velos',
        operationId: 'getVelos',
        summary: 'getVelos',
        description: 'Liste des vélos, voici la structure de données
        <ul>
            <li>velo_id : numéro unique d’identification du vélo.</li>
            <li>type : variable texte indiquant si le vélo est : mécanique ("mechanical") ou électrique ("ebike")</li>
            <li>status : variable texte indiquant si le vélo est : opérationnel ("available"), en cours de location ("location"), en anomalie ("fail") ou en cours de réparation ("repair")</li>
            <li>num_km_total : Nombre de kilometre</li>
            <li>station_id_available : ID station rattaché en moment et au départ</li>
        </ul>',
    )]
	#[Attributes\Response(
        response: '200',
        description: 'Liste des vélos sont transmis',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/velos',
                    summary: '/api/velos',
                    value: [
                        [
                            "velo_id" => 245671,
                            "type" => "mechanical",
                            "status" => "available",
                            "num_km_total" => 234,
                            "station_id_available" => 17278902806,
                        ],
                        [
                            "velo_id" => 434,
                            "type" => "ebike",
                            "status" => "available",
                            "num_km_total" => 457,
                            "station_id_available" => 17278902806,
                        ]
                    ]
                )
            ]
        )
    )]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\VeloRepository())->getAllVelo();
        if ($data === false) { return json_encode("Velo not found"); }

		return json_encode($data);
	}
}

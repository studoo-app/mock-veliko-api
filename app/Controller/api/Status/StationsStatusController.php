<?php

namespace Controller\api\Status;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationsStatusController implements ControllerInterface
{
	#[Attributes\Get(
        path: '/api/stations/status',
        tags: ['status', 'station'],
        operationId: 'getStationsStatus',
        summary: 'getStationsStatus',
        description: 'Liste des status des stations, voici la structure de données
        <ul>
            <li>station_id : numéro unique d’identification de la station. Ce numéro identifie la station au sein du service Vélib’ Métropole</li>
            <li>is_installed : variable binaire indiquant si la station est. La station a déjà été déployée (1) ou est encore en cours de déploiement (0)</li>
            <li>is_renting : variable binaire indiquant si la station peut louer des vélos (is_renting=1 si le statut de la station est Operative)</li>
            <li>is_returning : variable binaire indiquant si la station peut recevoir des vélos (is_renting=1 si le statut de la station est Operative)</li>
            <li>last_reported : date de la dernière mise-à-jour</li>
            <li>numBikesAvailable : nombre de vélos disponibles</li>
            <li>numDocksAvailable : nombre de bornettes disponibles</li>
            <li>num_bikes_available : nombre de vélos disponibles</li>
            <li>num_bikes_available_types : nombre de vélos disponibles avec distinctions entre Vélib’ mécanique et électrique</li>
        </ul>',
    )]
	#[Attributes\Response(
        response: '200',
        description: 'Liste des status des stations sont transmis',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/stations/status',
                    summary: '/api/stations/status',
                    value: [
                        [
                            'station_id' => '213688169',
                            'num_bikes_available' => 7,
                            'num_bikes_available_types' => [
                                'mechanical' => 7,
                                'ebike' => 0
                            ],
                            'num_docks_available' => 16,
                            'is_installed' => 1,
                            'is_returning' => 1,
                            'is_renting' => 1,
                            'last_reported' => 1633669200,
                        ],
                        [
                            'station_id' => '17278902806',
                            'num_bikes_available' => 4,
                            'num_bikes_available_types' => [
                                'mechanical' => 2,
                                'ebike' => 2
                            ],
                            'num_docks_available' => 15,
                            'is_installed' => 1,
                            'is_returning' => 1,
                            'is_renting' => 1,
                            'last_reported' => 1724180746,
                        ]
                    ]
                )
            ]
        )
    )]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationStatusRepository())->getAllStationsStatus();
        if ($data === false) { return json_encode("Stations not found"); }

		return json_encode($data);
	}
}

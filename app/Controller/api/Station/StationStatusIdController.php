<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Repository\VeloRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationStatusIdController implements ControllerInterface
{
	#[Attributes\Get(
        path: '/api/station/{id}/status[/{optional}]',
        tags: ['station'],
        operationId: 'getStationStatusById',
        description: 'Récupérer le status d une station par son ID (station_id)<br>
        Statut d une station dans son état actuel, celle-ci à une timestamp de dernière mise à jour (last_reported).<br>
        La description des champs:<br>
        - station_id: ID de la station<br>
        - stationCode: Code de la station<br>
        - name: Nom de la station<br>
        - lat: Latitude de la station<br>
        - lon: Longitude de la station<br>
        - capacity: Capacité de la station<br>
        - num_bikes_available: Nombre de vélos disponibles<br>
        - num_bikes_available_types: Nombre de vélos disponibles par type (mécanique, électrique)<br>
        - num_docks_available: Nombre de places disponibles<br>
        - is_installed: Installation de la station (voir dans la fonction getStationsStatus)<br>
        - is_returning: Recevoir des vélos dans la station (voir dans la fonction getStationsStatus)<br>
        - is_renting: Location de la station (voir dans la fonction getStationsStatus)<br>
        - last_reported: Timestamp de la dernière mise à jour de la station<br>
        - bikes_available_types: Liste des vélos disponibles avec distinction entre Vélib’ mécanique et électrique (optionnel)<br>
        Voir les exemples de reponse -> -> -><br>
        '
    )]
    #[Attributes\Parameter(
        name: 'id',
        description: 'ID de la station',
        in: 'path',
        required: true,
        schema: new Attributes\Schema(type: 'integer')
    )]
    #[Attributes\Parameter(
        name: 'optional',
        description: 'Element optionnel pour récupérer les vélos disponibles. Valeur possible: velo',
        in: 'path',
        required: false,
        schema: new Attributes\Schema(type: 'string')
    )]
	#[Attributes\Response(
        response: '200',
        description: 'Station status est récupéré avec succès',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/station/17278902806/status',
                    summary: '/api/station/17278902806/status',
                    value: [
                        'station_id' => 17278902806,
                        'stationCode' => 44015,
                        'name' => 'Rouget de L isle - Watteau',
                        "lat" => "48.778192750803",
                        "lon" => "2.3963020229163",
                        "capacity" => 20,
                        "num_bikes_available" => 4,
                        "num_bikes_available_types" => "[{\"mechanical\":1},{\"ebike\":3}]",
                        "num_docks_available" => 16,
                        "is_installed" => 1,
                        "is_returning" => 1,
                        "is_renting" => 1,
                        "last_reported" => 1724180445
                    ]
                ),
                new Attributes\Examples(
                    example: '/api/station/17278902806/status/velo',
                    summary: '/api/station/17278902806/status/velo',
                    value: [
                        'station_id' => 17278902806,
                        'stationCode' => 44015,
                        'name' => 'Rouget de L isle - Watteau',
                        "lat" => "48.778192750803",
                        "lon" => "2.3963020229163",
                        "capacity" => 20,
                        "num_bikes_available" => 4,
                        "num_bikes_available_types" => "[{\"mechanical\":1},{\"ebike\":2}]",
                        "num_docks_available" => 16,
                        "is_installed" => 1,
                        "is_returning" => 1,
                        "is_renting" => 1,
                        "last_reported" => 1724180445,
                        "bikes_available_types" => [
                            0 => [
                                "velo_id" => 245671,
                                "type" => "mechanical",
                                "status" => "available",
                                "num_km_total" => 234,
                                "station_id_available" => 17278902806,
                            ],
                            1 => [
                                "velo_id" => 37654,
                                "type" => "ebike",
                                "status" => "available",
                                "num_km_total" => 345,
                                "station_id_available" => 17278902806,
                            ],
                            2 => [
                                "velo_id" => 434,
                                "type" => "ebike",
                                "status" => "available",
                                "num_km_total" => 457,
                                "station_id_available" => 17278902806,
                            ]
                        ]
                    ]
                ),
            ]
        )
    )]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationRepository())->getOneStationStatus($request->get('id'));
        if ($data === false) { return json_encode("Station not found"); }
        if ($request->get('optional') === "velo") {
            $data['bikes_available_types'] = (new VeloRepository())->getVeloByStation($request->get('id'));
        }

		return json_encode($data);
	}
}

<?php

namespace Controller\api\Station;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class StationStatusIdController implements ControllerInterface
{
	#[Attributes\Get(
        path: '/api/station/{id}/status',
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
        - last_reported: Timestamp de la dernière mise à jour de la station
        '
    )]
    #[Attributes\Parameter(
        name: 'id',
        description: 'ID de la station',
        in: 'path',
        required: true,
        schema: new Attributes\Schema(type: 'integer')
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
                        "num_bikes_available_types" => "[{\"mechanical\":0},{\"ebike\":4}]",
                        "num_docks_available" => 16,
                        "is_installed" => 1,
                        "is_returning" => 1,
                        "is_renting" => 1,
                        "last_reported" => 1724180445
                    ]
                )
            ]
        )
    )]
	public function execute(Request $request): string|null
	{
		header('Content-Type: application/json');

        $data = (new \Repository\StationRepository())->getOneStationStatus($request->get('id'));

		return json_encode($data);
	}
}

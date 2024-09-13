<?php

namespace Controller\api\Velo;

use Core\AuthApi;
use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class VeloRestoreByIdController implements ControllerInterface
{
	#[Attributes\Put(
        path: '/api/velo/{velo_id}/restore/{station_id}',
        operationId: 'getVeloRestoreById',
        summary: 'getVeloRestoreById',
        description: 'Restaurer le vélo loué via son ID, Cette méthode permet de rendre le Vélo loué dans une station',
    )]
    #[Attributes\Parameter(
        name: 'velo_id',
        description: 'ID du vélo loué',
        in: 'path',
        required: true,
        schema: new Attributes\Schema(type: 'integer')
    )]
    #[Attributes\Parameter(
        name: 'station_id',
        description: 'ID de la nouvelle station d\'accueil',
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
                    example: '/api/velo/245671/restore/17278902806',
                    summary: '/api/velo/245671/restore/17278902806',
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

        if (AuthApi::checkToken($request) === false) { return json_encode("Token is not valid"); }

        $Velo = (new \Repository\VeloRepository())->getVeloById($request->get('velo_id'));
        if ($Velo === false) { return json_encode("Velo not found"); }
        if ($Velo["status"] === "available") { return json_encode("Velo statut is available"); }

        $station = (new \Repository\StationStatusRepository())->getStationsStatusById($request->get('station_id'));
        if ($station["num_docks_available"] === 0) { return json_encode("Station dock is full"); }

        $Velo["status"] = "available";
        $Velo["station_id_available"] = $request->get('station_id');
        (new \Repository\VeloRepository())->update($Velo);

        $station["num_bikes_available"] = $station["num_bikes_available"] + 1;
        $station["num_docks_available"] = $station["num_docks_available"] - 1;
        foreach ($station["num_bikes_available_types"] as $idPos => $typeVelo) {
            if (array_key_exists($Velo["type"], $typeVelo)) {
                $station["num_bikes_available_types"][$idPos][$Velo["type"]] = $station["num_bikes_available_types"][$idPos][$Velo["type"]] + 1;
            }
        }
        (new \Repository\StationStatusRepository())->update($station);

        return json_encode($Velo);
	}
}

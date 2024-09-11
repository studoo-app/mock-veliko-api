<?php

namespace Controller\api;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class InitController implements ControllerInterface
{
    #[Attributes\Get(
        path: '/api/init/data',
        operationId: 'initApiData',
        summary: 'initApiData',
        description: 'Initialisation de l\'API VELIKO se fait au dédut projet. Elle permet de récupérer les données des stations et des status des stations sur API officielle de VELIB',
    )]
    #[Attributes\Response(
        response: '200',
        description: 'Initialisation de l\'API VELIKO est excutée avec succès',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/init/data',
                    summary: '/api/init/data',
                    value: [
                        'status' => 'success',
                        'message' => 'API VELIKO is running'
                    ]
                )
            ]
        )
    )]
    #[Attributes\Response(
        response: '500',
        description: 'Erreur interne du serveur',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: 'error',
                    summary: 'Erreur interne',
                    value: [
                        'status' => 'error',
                        'message' => 'Une erreur interne est survenue, veuillez regarder les logs serveur'
                    ]
                )
            ]
        )
    )]
    public function execute(Request $request): string|null
    {
        header('Content-Type: application/json');

        try {
            $listTest = (new \Core\InitApi())->getData();
        } catch (\Exception $e) {
            http_response_code(500);
            $errorResponse = [
                "status" => "error",
                "message" => $e->getMessage()
            ];
            return json_encode($errorResponse);
        }

        return json_encode($listTest);
    }
}

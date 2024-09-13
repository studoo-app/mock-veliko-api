<?php

namespace Controller\api;

use OpenApi\Attributes;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;

class SchemaController implements ControllerInterface
{
    #[Attributes\Get(
        path: '/api/init/schema',
        operationId: 'initApiSchema',
        summary: 'initApiSchema',
        description: 'Initialisation de la scruture de la base de données de l\'API VELIKO se fait au dédut projet. Elle permet de créer les tables de la base de données',
    )]
    #[Attributes\Response(
        response: '200',
        description: 'Initialisation de la structure de l\'API VELIKO est excutée avec succès',
        content: new Attributes\MediaType(
            mediaType: 'application/json',
            examples: [
                new Attributes\Examples(
                    example: '/api/init/schema',
                    summary: '/api/init/schema',
                    value: [
                        'status' => 'success',
                        'message' => 'Structure API VELIKO is done'
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
            $listTest = (new \Controller\api\InitApi())->getStructure();
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

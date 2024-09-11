<?php

use Castor\Attribute\AsTask;

use function Castor\io;
use function Castor\capture;
use function Castor\run;

#[AsTask(name: 'doc:api', description: 'Génération de la documentation de l\'API')]
function generate_documentation_api(): void
{
    run('php vendor/bin/openapi app -o openapi.yaml');
    run('docker run --rm -v $PWD:/spec redocly/cli build-docs openapi.yaml --output=./app/Template/api/redoc.html');
}

#[AsTask(name: 'install', description: 'Génération de la documentation de l\'API')]
function install(): void
{
    run('docker pull redocly/cli');
    run('composer install');
}


#[AsTask(name: 'doc:start:serv', description: 'Démarrage du serveur de documentation')]
function doc_server_start(): void
{
    run('source venv/bin/activate && mkdocs serve');
}
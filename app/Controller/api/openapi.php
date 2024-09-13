<?php

namespace Controller\api;

use OpenApi\Attributes;

#[Attributes\Info(title: 'API VELIKO', version: '0.3.0', description: 'API VELIKO est une API de gestion des stations de vélos en libre service')]
#[Attributes\Server(url: 'http://localhost:8042')]
#[Attributes\Contact(email: 'Benoit.Foujols@ac-creteil.fr', name: 'Benoit Foujols')]
#[Attributes\License(name: 'MIT', url: 'https://opensource.org/licenses/MIT')]
class openapi
{
}

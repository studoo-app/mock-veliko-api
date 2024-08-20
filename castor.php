<?php

use Castor\Attribute\AsTask;

use function Castor\io;
use function Castor\capture;

#[AsTask(description: 'Welcome to Castor!')]
function hello(): void
{
    $currentUser = capture('whoami');

    io()->title(sprintf('Hello %s!', $currentUser));
}
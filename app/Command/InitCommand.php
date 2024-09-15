<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'init', description: 'Renseigner la description de la commande init')]
class InitCommand extends \Studoo\EduFramework\Commands\Extends\CommandManage
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{

            (new \Controller\api\InitApi())->getStructure();
            (new \Controller\api\InitApi())->getData();
            (new \Controller\api\InitApi())->copyConfig();

		    return Command::SUCCESS;
	}
}

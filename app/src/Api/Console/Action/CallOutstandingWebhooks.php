<?php

declare(strict_types=1);

namespace Api\Console\Action;

use Api\Console\InputCommandFactory;
use Api\Console\ResultOutputFormatter;
use Shrikeh\App\Command\CommandBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'ticket-tailor:webhooks:call',
    description: 'Calls all outstanding webhooks'
)]
final class CallOutstandingWebhooks extends Command
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly InputCommandFactory $inputCommandFactory,
        private readonly ResultOutputFormatter $resultOutputFormatter,
    ) {
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->commandBus->handle(
            $this->inputCommandFactory->create($input, $output)
        );

        $this->resultOutputFormatter->render($result, $input, $output);

        return Command::SUCCESS;
    }
}

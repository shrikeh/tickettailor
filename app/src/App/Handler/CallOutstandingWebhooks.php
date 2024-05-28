<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\CallOutstandingWebhooks as CallOutstandingWebhooksCommand;
use App\Command\CallWebhooks;
use App\Query\OutstandingWebhooks as OutstandingWebhooksQuery;
use App\Result\OutstandingWebhooks as OutstandingWebhooksResult;
use App\Result\OutstandingWebhooksCalled;
use Shrikeh\App\Bus\BusContext;
use Shrikeh\App\Command\CommandBus;
use Shrikeh\App\Command\CommandHandler;
use Shrikeh\App\Log;
use Shrikeh\App\Query\QueryBus;

final readonly class CallOutstandingWebhooks implements CommandHandler
{
    public function __construct(
        private QueryBus $queryBus,
        private CommandBus $commandBus,
        private Log $log,
    ) {
    }

    public function __invoke(CallOutstandingWebhooksCommand $command): OutstandingWebhooksCalled
    {
        $this->logStart($command);
        /** @var OutstandingWebhooksResult $webhookResults */
        $outstandingWebhooks = $this->queryBus->handle(
            OutstandingWebhooksQuery::init()->withCorrelation($command->correlated())
        );

        $result = $this->commandBus->handle((new CallWebhooks())->withCorrelation(
            $outstandingWebhooks->correlated(),
        ));
    }

    private function logStart(CallOutstandingWebhooksCommand $command): void
    {
        $this->log->info(sprintf(
            'Starting calling outstanding webhooks: X-ID %s',
            $command->correlated()->toString(),
        ), BusContext::MESSAGE_START);
    }
}

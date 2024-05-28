<?php

declare(strict_types=1);

namespace Api\Console\Action\CallOutstandingWebhooks;

use Api\Console\ResultOutputFormatter;
use App\Result\OutstandingWebhooksCalled;
use Shrikeh\App\Message\Result;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final readonly class OutstandingWebhooksResultFormatter implements ResultOutputFormatter
{

    public function render(?Result $result, InputInterface $input, OutputInterface $output): void
    {
        $table = new Table($output);
        $table->setHeaders(['Order ID', 'Result']);
        $this->renderWebhookResults($result, $table);

        $table->render();
    }

    private function renderWebhookResults(
        OutstandingWebhooksCalled $outstandingWebhooksCalled,
        Table $table,
    ) {
        // @todo: Add colours for success and failure
        foreach ($outstandingWebhooksCalled->webhookResults as $orderId => $result) {
            $table->addRow([$orderId, ($result) ? 'Success' : 'Failure']);
        }
    }
}

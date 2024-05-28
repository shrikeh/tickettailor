<?php

declare(strict_types=1);

namespace Api\Console\Action\CallOutstandingWebhooks;

use Api\Console\ResultOutputFormatter;
use Shrikeh\App\Message\Result;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final readonly class OutstandingWebhooksResultFormatter implements ResultOutputFormatter
{

    public function render(?Result $result, InputInterface $input, OutputInterface $output): void
    {
        // TODO: Implement render() method.
    }
}

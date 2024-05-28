<?php

declare(strict_types=1);

namespace Api\Console\Action\CallOutstandingWebhooks;

use Api\Console\InputCommandFactory;
use App\Command\CallOutstandingWebhooks;
use Shrikeh\App\Message\Correlation;
use Shrikeh\App\Uid\Id\Ulid\CorrelationUlid;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final readonly class CallOutstandingWebhooksFactory implements InputCommandFactory
{

    public function create(InputInterface $input, OutputInterface $output): CallOutstandingWebhooks
    {
        $correlationId = CorrelationUlid::init();
       $correlation = new Correlation(
           $correlationId,
           $correlationId->getDateTime(),
       );

       return CallOutstandingWebhooks::init()->withCorrelation($correlation);
    }
}

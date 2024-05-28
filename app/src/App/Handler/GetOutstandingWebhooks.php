<?php

declare(strict_types=1);

namespace App\Handler;

use App\Query\OutstandingWebhooks;
use App\Result\OutstandingWebhooks as OutstandingWebhooksResult;
use Shrikeh\App\Query\QueryHandler;
use TicketTailor\TechnicalTest\CustomerNotifications;

final readonly class GetOutstandingWebhooks implements QueryHandler
{
    public function __construct(private CustomerNotifications $customerNotifications)
    {
    }
    public function __invoke(OutstandingWebhooks $outstandingWebhooks): OutstandingWebhooksResult
    {
        $result = new OutstandingWebhooksResult(
            $this->customerNotifications->fetchOutstanding()
        );

        return $result->withCorrelation($outstandingWebhooks->correlated());
    }
}

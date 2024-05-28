<?php

declare(strict_types=1);

namespace App\Result;

use App\Traits\WithCorrelation;
use Generator;
use Psr\Http\Message\UriInterface;
use Shrikeh\App\Message\Correlated;
use Shrikeh\App\Message\Correlation;
use Shrikeh\App\Message\Result;
use TicketTailor\TechnicalTest\Webhooks;

final readonly class OutstandingWebhooks implements Result, Correlated
{
    use WithCorrelation;

    public function __construct(
        private Webhooks $webhooks
    ) {
    }

    /**
     * @return Generator<UriInterface>
     */
    public function webhooks(): Generator
    {
        foreach ($this->webhooks->webhooks() as $uri) {
            yield $uri;
        }
    }

}

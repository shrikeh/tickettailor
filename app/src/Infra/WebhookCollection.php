<?php

declare(strict_types=1);

namespace Infra;

use Generator;
use TicketTailor\TechnicalTest\Webhooks;

final readonly class WebhookCollection implements Webhooks
{
    public function __construct(private iterable $webhooks)
    {
    }

    public function webhooks(): Generator
    {
        yield from $this->webhooks;
    }
}

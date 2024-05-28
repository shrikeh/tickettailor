<?php

declare(strict_types=1);

namespace App\Result;

use App\Traits\WithCorrelation;
use Shrikeh\App\Message\Correlated;
use Shrikeh\App\Message\Result;
use TicketTailor\TechnicalTest\Webhooks;

final readonly class OutstandingWebhooks implements Result, Correlated
{
    use WithCorrelation;

    public function __construct(public Webhooks $webhooks)
    {
    }
}

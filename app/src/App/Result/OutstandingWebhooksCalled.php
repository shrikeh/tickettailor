<?php

declare(strict_types=1);

namespace App\Result;

use App\Traits\WithCorrelation;
use Shrikeh\App\Message\Correlated;
use Shrikeh\App\Message\Result;

final readonly class OutstandingWebhooksCalled implements Result, Correlated
{
    use WithCorrelation;

    public function __construct(public array $webhookResults)
    {
    }
}

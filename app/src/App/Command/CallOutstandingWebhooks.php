<?php

declare(strict_types=1);

namespace App\Command;

use App\Traits\WithCorrelation;
use Shrikeh\App\Message\Command;
use Shrikeh\App\Message\Correlated;
use Shrikeh\App\Message\Correlation;

final readonly class CallOutstandingWebhooks implements Command, Correlated
{
    use WithCorrelation;

    public static function init(): self
    {
        return new self();
    }

    private function __construct()
    {
    }
}

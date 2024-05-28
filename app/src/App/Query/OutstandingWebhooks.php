<?php

declare(strict_types=1);

namespace App\Query;

use App\Traits\WithCorrelation;
use Shrikeh\App\Message\Correlated;
use Shrikeh\App\Message\Query;

final readonly class OutstandingWebhooks implements Query, Correlated
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

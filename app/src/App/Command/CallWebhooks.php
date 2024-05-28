<?php

declare(strict_types=1);

namespace App\Command;

use App\Traits\WithCorrelation;
use Shrikeh\App\Message\Command;
use Shrikeh\App\Message\Correlated;

final readonly class CallWebhooks implements Command, Correlated
{
    use WithCorrelation;
}

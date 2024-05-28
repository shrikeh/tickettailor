<?php

declare(strict_types=1);

namespace Tests\Unit\Traits;

use Shrikeh\App\Message\Correlation;
use Shrikeh\App\Uid\Id\Ulid\CorrelationUlid;

trait CreateCorrelation
{
    private function correlation(): Correlation
    {
        $correlationId = CorrelationUlid::init();
        return new Correlation(
            $correlationId,
            $correlationId->getDateTime(),
        );
    }
}

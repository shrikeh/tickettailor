<?php

declare(strict_types=1);

namespace App\Traits;

use Shrikeh\App\Message\Correlation;

trait WithCorrelation
{
    private readonly Correlation $correlation;

    public function correlated(): Correlation
    {
        return $this->correlation;
    }

    public function withCorrelation(Correlation $correlation): static
    {
        $correlated = clone $this;
        $correlated->correlation = $correlation;

        return $correlated;
    }
}

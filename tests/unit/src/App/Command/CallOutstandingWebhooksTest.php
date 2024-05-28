<?php

declare(strict_types=1);

namespace Tests\Unit\App\Command;

use App\Command\CallOutstandingWebhooks;
use PHPUnit\Framework\TestCase;
use Shrikeh\App\Message\Correlation;
use Shrikeh\App\Uid\Id\Ulid\CorrelationUlid;

final class CallOutstandingWebhooksTest extends TestCase
{
    public function testItHasCorrelation(): void
    {
        $correlation = new Correlation(CorrelationUlid::init());
        $command = CallOutstandingWebhooks::init()->withCorrelation($correlation);

        $this->assertSame($correlation, $command->correlated());
    }
}

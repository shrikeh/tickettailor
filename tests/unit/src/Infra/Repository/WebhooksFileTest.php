<?php

declare(strict_types=1);

namespace Tests\Unit\Infra\Repository;

use Infra\Repository\WebhooksFile;
use PHPUnit\Framework\TestCase;
use SplFileInfo;
use Tests\Utils\Constants;

final class WebhooksFileTest extends TestCase
{
    public function testItReturnsWebhooks(): void
    {
        $splFileInfo = new SplFileInfo(sprintf('%s/webhooks.txt', Constants::fixturesDir()));

        $webhooksFileRepository = new WebhooksFile($splFileInfo);

        $uris = iterator_to_array($webhooksFileRepository->fetchOutstandingNotifications()->webhooks());

        $this->assertCount(10, $uris);
        $this->assertSame([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], array_keys($uris));
    }
}

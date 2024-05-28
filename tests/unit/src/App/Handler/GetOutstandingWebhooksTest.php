<?php

declare(strict_types=1);

namespace Tests\Unit\App\Handler;

use App\Handler\GetOutstandingWebhooks;
use App\Query\OutstandingWebhooks as OutstandingWebhookQuery;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Shrikeh\App\Message\Correlation;
use Tests\Unit\Traits\CreateCorrelation;
use TicketTailor\TechnicalTest\CustomerNotifications;
use TicketTailor\TechnicalTest\CustomerNotifications\NotificationsRepository;
use TicketTailor\TechnicalTest\Webhooks;

final class GetOutstandingWebhooksTest extends TestCase
{
    use CreateCorrelation;
    use ProphecyTrait;
    public function testItReturnsWebhooks(): void
    {
        $webhooks = $this->prophesize(Webhooks::class)->reveal();
        $repository = $this->prophesize(NotificationsRepository::class);
        $repository->fetchOutstandingNotifications()->willReturn($webhooks);
        $customerNotifications = new CustomerNotifications($repository->reveal());

        $handler = new GetOutstandingWebhooks($customerNotifications);
        $correlation = $this->correlation();
        $query = OutstandingWebhookQuery::init()->withCorrelation($correlation);

        $result = $handler($query);

        $this->assertSame($webhooks, $result->webhooks);
        $this->assertSame($correlation, $result->correlated());
    }
}

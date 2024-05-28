<?php

declare(strict_types=1);

namespace Tests\Unit\Api\Console\Action\CallOutstandingWebhooks;

use Api\Console\Action\CallOutstandingWebhooks\CallOutstandingWebhooksFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Shrikeh\App\Message\Correlation;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CallOutstandingWebhooksFactoryTest extends TestCase
{

    use ProphecyTrait;
    public function testItReturnsACorrelatedCommand(): void
    {
        $input = $this->prophesize(InputInterface::class)->reveal();
        $output = $this->prophesize(OutputInterface::class)->reveal();

        $commandFactory = new CallOutstandingWebhooksFactory();

        $this->assertInstanceOf(
            Correlation::class,
            $commandFactory->create($input, $output)->correlated(),
        );
    }
}

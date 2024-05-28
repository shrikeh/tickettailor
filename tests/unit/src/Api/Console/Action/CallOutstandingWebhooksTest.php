<?php

declare(strict_types=1);

namespace Tests\Unit\Api\Console\Action;

use Api\Console\Action\CallOutstandingWebhooks;
use Api\Console\InputCommandFactory;
use Api\Console\ResultOutputFormatter;
use App\Command\CallOutstandingWebhooks as CallOutstandingWebhooksCommand;
use App\Result\OutstandingWebhooksCalled;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Shrikeh\App\Command\CommandBus;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CallOutstandingWebhooksTest extends TestCase
{
    use ProphecyTrait;

    public function testItExecutesCalliungOutstandingWebhooks(): void
    {
        $input = new ArrayInput([]);

        $output = $this->prophesize(OutputInterface::class)->reveal();
        $inputCommandFactory = $this->prophesize(InputCommandFactory::class);
        $command = CallOutstandingWebhooksCommand::init();
        $result = $this->prophesize(OutstandingWebhooksCalled::class)->reveal();
        $inputCommandFactory->create($input, $output)->willReturn($command);

        $commandBus = $this->prophesize(CommandBus::class);

        $commandBus->handle($command)->willReturn($result);

        $resultOutputFormatter = $this->prophesize(ResultOutputFormatter::class);
        $resultOutputFormatter->render($result, $input, $output)->shouldBeCalledOnce();

        $consoleCommand = new CallOutstandingWebhooks(
            $commandBus->reveal(),
            $inputCommandFactory->reveal(),
            $resultOutputFormatter->reveal(),
        );

        $consoleCommand->run($input, $output);
    }
}

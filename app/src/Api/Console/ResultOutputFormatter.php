<?php

declare(strict_types=1);

namespace Api\Console;

use Shrikeh\App\Message\Result;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ResultOutputFormatter
{
    public function render(
        Result|null $result,
        InputInterface $input,
        OutputInterface $output
    ): void;
}

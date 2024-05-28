<?php

declare(strict_types=1);

namespace Api\Console;

use Shrikeh\App\Message\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface InputCommandFactory
{
    public function create(InputInterface $input, OutputInterface $output): Command;
}

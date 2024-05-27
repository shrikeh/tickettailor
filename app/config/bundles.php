<?php

declare(strict_types=1);

use Shrikeh\App\Bundle\App;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;

return [
    FrameworkBundle::class => ['all' => true],
    App::class => ['all' => true],
];

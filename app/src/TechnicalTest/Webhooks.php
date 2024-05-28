<?php

declare(strict_types=1);

namespace TicketTailor\TechnicalTest;

use Psr\Http\Message\UriInterface;

interface Webhooks
{
    /**
     * @return iterable<UriInterface>
     */
    public function webhooks(): iterable;
}

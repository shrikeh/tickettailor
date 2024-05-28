<?php

declare(strict_types=1);

namespace TicketTailor\TechnicalTest\CustomerNotifications;

use TicketTailor\TechnicalTest\Webhooks;

interface NotificationsRepository
{
    public function fetchOutstandingNotifications(): Webhooks;
}

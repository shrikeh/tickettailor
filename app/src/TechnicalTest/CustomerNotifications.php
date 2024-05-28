<?php

declare(strict_types=1);

namespace TicketTailor\TechnicalTest;

use TicketTailor\TechnicalTest\CustomerNotifications\NotificationsRepository;

final readonly class CustomerNotifications
{
    public function __construct(private NotificationsRepository $notificationsRepository)
    {
    }
    public function fetchOutstanding(): Webhooks
    {
        return $this->notificationsRepository->fetchOutstandingNotifications();
    }
}

<?php

declare(strict_types=1);

namespace Infra\Repository;

use Generator;
use Infra\WebhookCollection;
use League\Csv\Reader;
use Nyholm\Psr7\Uri;
use SplFileInfo;
use TicketTailor\TechnicalTest\CustomerNotifications\NotificationsRepository;

final readonly class WebhooksFile implements NotificationsRepository
{
    public function __construct(private SplFileInfo $webhooksFile)
    {
    }

    public function fetchOutstandingNotifications(): WebhookCollection
    {
        return new WebhookCollection($this->getWebhooks());
    }

    private function getWebhooks(): Generator
    {
        foreach ($this->getOrders() as $order) {
            $cleaned = iterator_to_array($this->cleanupOrder($order));

            yield (int) $cleaned['ORDER ID'] => new Uri($cleaned['URL']);
        }
    }

    private function cleanupOrder(array $order): Generator
    {
        foreach($order as $header => $value) {
            yield trim($header) => trim($value);
        }
    }

    private function getOrders(): Generator
    {
        $webhooks = Reader::createFromFileObject($this->webhooksFile->openFile());
        $webhooks->setHeaderOffset(0);

        yield from $webhooks->getRecords();
    }
}

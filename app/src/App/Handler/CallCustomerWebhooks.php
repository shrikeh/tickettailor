<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\CallWebhooks;
use App\Result\OutstandingWebhooks;
use Exception;
use Psr\Http\Message\UriInterface;
use Shrikeh\App\Command\CommandHandler;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final readonly class CallCustomerWebhooks implements CommandHandler
{

    public function __construct(private HttpClientInterface $httpClient)
    {

    }
    public function __invoke(CallWebhooks $callWebhooks): OutstandingWebhooks
    {
        foreach ($callWebhooks->webhooks as $orderId => $uri) {
            $response = $this->executeRequest($uri);
        }
    }

    private function executeRequest(UriInterface $uri): ResponseInterface
    {
        $retryDelay = 1;
        for ($attempts = 0; $attempts < 5; $attempts++) {
            try {
                $response = $this->httpClient->request('GET', (string) $uri);

                if ($response->getStatusCode() === 200) {
                    return $response;
                }
            } catch (TransportExceptionInterface $exc) {
                sleep($retryDelay);
                $retryDelay = min($retryDelay * 2, 60);
            }
        }
    }
}

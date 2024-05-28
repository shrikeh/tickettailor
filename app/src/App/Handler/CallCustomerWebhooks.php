<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\CallWebhooks;
use App\Result\OutstandingWebhooksCalled;
use Exception;
use Psr\Http\Message\UriInterface;
use Shrikeh\App\Command\CommandHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final readonly class CallCustomerWebhooks implements CommandHandler
{

    public function __construct(private HttpClientInterface $httpClient)
    {
    }
    public function __invoke(CallWebhooks $callWebhooks): OutstandingWebhooksCalled
    {
        $results = [];
        foreach ($callWebhooks->webhooks->webhooks() as $orderId => $uri) {
            $callSuccess = false;
            if ($response = $this->executeRequest($uri)) {
                if ($response->getStatusCode() === 200) {
                    $callSuccess = true;
                }
            }
            $results[$orderId] = $callSuccess;
        }

        return (new OutstandingWebhooksCalled($results))->withCorrelation($callWebhooks->correlated());
    }

    private function executeRequest(UriInterface $uri): ?ResponseInterface
    {
        $retryDelay = 1;
        for ($attempts = 0; $attempts < 5; $attempts++) {
            try {
                $response = $this->httpClient->request('GET', (string) $uri);
                $response->getContent();

                return $response;
            } catch (Exception $exc) {
                sleep($retryDelay);
                $retryDelay = min($retryDelay * 2, 60);
            }
        }
        return null;
    }
}

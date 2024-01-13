<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Enum\HttpMethod;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

readonly abstract class AbstractApiRepository
{
    protected const API_HOST = '';

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    protected function request(
        HttpMethod $httpMethod,
        string $endpoint,
        array|object|string|null $body = null,
        ?array $query = null,
        ?array $headers = null
    ): ResponseInterface {
        try {
            return $this->client->request(
                $httpMethod->value,
                $this->buildUrl($endpoint, $query),
                $this->buildOptions($body, $headers)
            );
        } catch (TransportExceptionInterface $e) {
            // log
            throw $e;
        }
    }

    private function buildUrl(string $endpoint, ?array $query = null): string
    {
        $queryParams = '';

        if (is_array($query)) {
            $queryParams = '?' . http_build_query($query);
        }

        return sprintf(
            '%s%s%s',
            static::API_HOST,
            $endpoint,
            $queryParams
        );
    }

    private function buildOptions(
        array|object|string|null $body = null,
        ?array $headers = null
    ): array {
        $options = [];

        if (is_array($headers)) {
            $options['headers'] = $headers;
        }

        if (null !== $body) {
            $options['body'] = $body;
        }

        return $options;
    }
}
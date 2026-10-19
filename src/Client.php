<?php
namespace IsaechSolutions\Sdk;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use IsaechSolutions\Sdk\Services\DomainService;
use IsaechSolutions\Sdk\Services\HostingService;
use IsaechSolutions\Sdk\Services\SmsService;

class Client
{
    private HttpClient $httpClient;

    /**
     * Service instance handlers
     */
    public SmsService $sms;

    public function __construct(
        private string $apiKey,
        private string $baseUrl = Config::BASE_URL,
        private float $timeout = Config::DEFAULT_TIMEOUT
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/') . '/';

        $this->httpClient = new HttpClient([
            'base_uri' => $this->baseUrl,
            'timeout'  => $this->timeout,
            'headers'  => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'User-Agent'    => Config::USER_AGENT,
            ],
        ]);

        $this->sms = new SmsService($this);
    }

    /**
     * Execute HTTP requests to the Isaech Solutions API
     *
     * @param string $method HTTP Method (GET, POST, PUT, DELETE)
     * @param string $endpoint Relative API endpoint path
     * @param array $options Guzzle request options (json, query, headers, etc.)
     * @return array Decoded JSON response
     * @throws \Exception
     */
    public function request(string $method, string $endpoint, array $options = []): array
    {
        try {
            $response = $this->httpClient->request($method, ltrim($endpoint, '/'), $options);
            $body     = $response->getBody()->getContents();

            return json_decode($body, true) ?? [];
        } catch (GuzzleException $e) {
            throw new \Exception("Isaech API Request Error: " . $e->getMessage(), $e->getCode(), $e);
        }
    }
}

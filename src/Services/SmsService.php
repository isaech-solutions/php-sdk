<?php

namespace IsaechSolutions\Sdk\Services;

use IsaechSolutions\Sdk\Client;

class SmsService
{
    public function __construct(private Client $client) {}

    /**
     * Send Bulk SMS to one or multiple recipients
     */
    public function sendBulk(array $recipients, string $message, string $senderId = ''): array
    {
        return $this->client->request('POST', 'sms/send', [
            'json' => [
                'recipients' => $recipients,
                'message'    => $message,
                'sender_id'  => $senderId,
            ],
        ]);
    }

    /**
     * Get the status/delivery report of a specific message
     */
    private function getDeliveryReport(string $messageId): array
    {
        return $this->client->request('GET', "sms/reports/{$messageId}");
    }

    /**
     * Fetch transmission history with optional pagination
     */
    public function getHistory(int $page = 1, int $limit = 50): array
    {
        return $this->client->request('GET', 'sms/history', [
            'query' => [
                'page'  => $page,
                'limit' => $limit,
            ],
        ]);
    }
}
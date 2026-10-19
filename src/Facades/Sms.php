<?php

namespace IsaechSolutions\Sdk\Facades;

use IsaechSolutions\Sdk\Client;

/**
 * @method static array sendBulk(array $recipients, string $message, string $senderId = '')
 * @method static array getDeliveryReport(string $messageId)
 * @method static array getHistory(int $page = 1, int $limit = 50)
 *
 * @see \IsaechSolutions\Sdk\Services\SmsService
 */
class Sms extends Facade
{
    protected static function getServiceInstance(Client $client)
    {
        return $client->sms;
    }
}
<?php

namespace IsaechSolutions\Sdk\Facades;

use IsaechSolutions\Sdk\Config;

class Isaech
{
    /**
     * Bootstrap the SDK globally with your API key
     */
    public static function init(string $apiKey, string $baseUrl = Config::BASE_URL): void
    {
        Facade::init($apiKey, $baseUrl);
    }
}
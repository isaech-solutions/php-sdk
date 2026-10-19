<?php
namespace IsaechSolutions\Sdk\Facades;

use IsaechSolutions\Sdk\Client;
use IsaechSolutions\Sdk\Config;

abstract class Facade
{
    protected static ?Client $client = null;

    /**
     * Initialize the client instance globally
     */
    public static function init(string $apiKey, string $baseUrl = Config::BASE_URL): void
    {
        self::$client = new Client($apiKey, $baseUrl);
    }

    /**
     * Set a custom Client instance directly
     */
    public static function setClient(Client $client): void
    {
        self::$client = $client;
    }

    /**
     * Get the sub-service class instance from the client
     */
    abstract protected static function getServiceInstance(Client $client);

    /**
     * Dynamically proxy static calls to the service instance
     */
    public static function __callStatic(string $method, array $args)
    {
        if (! self::$client) {
            throw new \RuntimeException(
                "Isaech Solutions SDK is not initialized. Call Isaech::init('YOUR_API_KEY') before calling static services."
            );
        }

        $service = static::getServiceInstance(self::$client);

        if (! method_exists($service, $method)) {
            throw new \BadMethodCallException(
                "Method '{$method}' does not exist on " . get_class($service)
            );
        }

        return $service->$method(...$args);
    }
}

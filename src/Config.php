<?php

namespace IsaechSolutions\Sdk;

class Config
{
    /**
     * Default API Endpoints
     */
    public const BASE_URL = 'https://api.isaech.solutions/';
    private const SANDBOX_URL = 'https://sandbox.api.isaech.csolutions/';

    /**
     * Default HTTP Settings
     */
    public const DEFAULT_TIMEOUT = 15.0; // Seconds

    /**
     * SDK Version & Metadata
     */
    public const VERSION = '0.0.1';
    public const USER_AGENT = 'IsaechSolutions-PHP-SDK/' . self::VERSION;
}
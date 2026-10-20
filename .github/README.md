# Isaech Solutions PHP SDK

[![Latest Version](https://img.shields.io/packagist/v/isaech-solutions/sdk.svg?style=flat-square)](https://packagist.org/packages/isaech-solutions/sdk)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=flat-square)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-blue.svg?style=flat-square)](https://php.net)

An official PHP library for interacting with **Isaech Solutions** APIs. Seamlessly manage Bulk SMS, domain availability checks, and hosting account statuses directly inside your PHP applications.

---

## Features

- **Bulk SMS**: Send single or batch SMS messages, schedule future dispatches, and fetch transmission logs.
- **Domains**: Perform real-time domain availability lookups and bulk extension searches.
- **Hosting**: Check hosting account health, query packages, and monitor service statuses.
- **Dual Syntax**: Choose between convenient **Static Facades** (`Sms::sendBulk()`) or clean **Dependency Injection** (`$client->sms->sendBulk()`).

---

## Requirements

- PHP `8.0` or higher
- `guzzlehttp/guzzle` `^7.5`
- `ext-json`

---

## Installation

Install the package via Composer:

```bash
composer require isaech-solutions/sdk
```

---

## Basic Usage

### 1. Initialize
First, load your API key once in your application's bootstrap file (e.g., `index.php` or `AppServiceProvider`):

```php
use IsaechSolutions\Sdk\Facades\Isaech;

// Initialize SDK globally
Isaech::init('YOUR_ISAECH_API_KEY');
```

---

## SMS Service Usage Guide

The SMS service provides flexible options for sending individual or mass text messages, utilizing custom Sender IDs, scheduling messages, and querying account transmission history.

### 1. Send Single or Bulk SMS

Pass either a single mobile number or an array of recipient phone numbers. Numbers should be formatted in standard E.164 format (including international country codes).

```php
use IsaechSolutions\Sdk\Facades\Sms;

// Send to multiple recipients
$result = Sms::sendBulk(
    recipients: [
        '+263770000000',
        '+263710000000',
        '+263730000000'
    ],
    message: 'Dear Customer, your invoice #1042 is ready for download.',
    senderId: 'ISAECH'
);

/**
 * Sample Response:
 * [
 *     'status' => sent,
 *     'cost' => '0.03',
 *     'balance' => 0.97,
 *     'message' => 'Dear Customer, your invoice #1042 is ready for download.',
 * ]
 */
```

---

### 2. Custom Sender ID

Use custom alphanumeric Sender IDs so your company brand appears as the sender name rather than a raw phone number:

```php
// Send using a custom brand Sender ID (up to 11 alphanumeric characters)
$response = Sms::sendBulk(
    recipients: ['+263770000000'],
    message: 'Your verification OTP code is: 948210',
    senderId: 'MyBrand'
);
```

---

### 3. Fetch Transmission History & Logs

Retrieve paginated history records of sent SMS messages. This is useful for populating internal analytics dashboards, logs, or user interface audit trails.

```php
use IsaechSolutions\Sdk\Facades\Sms;

// Fetch page 1 with 25 records per page
$history = Sms::getHistory(page: 1, limit: 25);

/**
 * Sample Response:
 * [
 *     'current_page' => 1,
 *     'total_pages' => 4,
 *     'total' => 88,
 *     'per_page' => 22,
 *     'success' => true,
 *     'data' => [
 *         [
 *             'id' => 'msg_01',
 *             'recipient' => '+263770000000',
 *             'message' => 'Your order has shipped.',
 *             'status' => 'sent',
 *             'created_at' => '2026-10-20 04:00:00'
 *         ],
 *         // ...
 *     ]
 * ]
 */
```
---

## Alternative Syntax: Instance Approach

If you prefer explicit dependency injection or manage multiple accounts with different API keys:

```php
use IsaechSolutions\Sdk\Client;

$client = new Client('YOUR_ISAECH_API_KEY');

// Execute SMS requests directly via the client instance
$response = $client->sms->sendBulk(
    recipients: ['+263770000000'],
    message: 'Hello via Instance approach'
);
```

---

## Error Handling

Catch API or network exceptions directly:

```php
use IsaechSolutions\Sdk\Facades\Isaech;
use IsaechSolutions\Sdk\Facades\Sms;
use Exception;

try {
    Isaech::init('YOUR_API_KEY');

    $response = Sms::sendBulk(
        recipients: ['+263770000000'],
        message: 'Testing error handling'
    );
} catch (Exception $e) {
    echo "Isaech SDK Error: " . $e->getMessage();
}
```
---

## License

The Isaech Solutions PHP SDK is open-source software licensed under the [MIT License](LICENSE).
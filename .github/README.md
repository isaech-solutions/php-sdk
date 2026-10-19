# Isaech Solutions PHP SDK

[![Latest Version](https://img.shields.io/packagist/v/isaech-solutions/sdk.svg?style=flat-square)](https://packagist.org/packages/isaech-solutions/sdk)
[![License](https://img.shields.io/packagist/l/isaech-solutions/sdk.svg?style=flat-square)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-blue.svg?style=flat-square)](https://php.net)

An official PHP library for interacting with **Isaech Solutions** APIs. Seamlessly manage Bulk SMS, domain availability checks, and hosting account statuses directly inside your PHP applications.

---

## Features

- **Bulk SMS**: Send single or batch SMS messages, track delivery reports, and fetch message logs.
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

# Google SearchConsole API for Laravel

[![Build Status](https://travis-ci.com/kawax/laravel-google-searchconsole.svg?token=wkkMzzpvNjzrZivG4aGb&branch=master)](https://travis-ci.com/kawax/laravel-google-searchconsole)
[![Maintainability](https://api.codeclimate.com/v1/badges/74439a91df19143ff593/maintainability)](https://codeclimate.com/github/kawax/laravel-google-searchconsole/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/74439a91df19143ff593/test_coverage)](https://codeclimate.com/github/kawax/laravel-google-searchconsole/test_coverage)

https://developers.google.com/webmaster-tools

## Requirements
- PHP >= 8.2
- Laravel >= 11.0

## Versioning
- Basic : semver
- Drop old PHP or Laravel version : `+0.1`. composer should handle it well.
- Support only latest major version (`master` branch), but you can PR to old branches.

## Installation

```
composer require revolution/laravel-google-searchconsole
```

### Get API Credentials
from https://developers.google.com/console  
Enable `Google Search Console API`.

### config/google.php
```php
    'client_id'        => env('GOOGLE_CLIENT_ID', ''),
    'client_secret'    => env('GOOGLE_CLIENT_SECRET', ''),
    'redirect_uri'     => env('GOOGLE_REDIRECT', ''),
    'scopes'           => [\Google\Service\Webmasters::WEBMASTERS],
    'access_type'      => 'offline',
    'approval_prompt'  => 'force',
    'prompt'           => 'consent', //"none", "consent", "select_account" default:none
```

### config/service.php for Socialite

```php
    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID', ''),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', ''),
        'redirect'      => env('GOOGLE_REDIRECT', ''),
    ],
```

### Configure .env as needed
```
GOOGLE_APPLICATION_NAME=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT=
```

## Query class
Subclass of Google\Service\Webmasters\SearchAnalyticsQueryRequest.

### Make command
Create at `app/Search`

```
php artisan make:search:query NewQuery 
```

Query class must have `init()` method.

```php
namespace App\Search;

use Revolution\Google\SearchConsole\Query\AbstractQuery;

class NewQuery extends AbstractQuery
{
    public function init(): void
    {
        $this->setStartDate(now()->subMonthWithoutOverflow()->toDateString());
        $this->setEndDate(now()->toDateString());
        $this->setDimensions(['query']);
        $this->setAggregationType(['auto']);
        $this->setRowLimit(100);
    }
}
```

## LICENSE
MIT  

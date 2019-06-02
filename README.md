# Google SearchConsole API for Laravel

[![Build Status](https://travis-ci.com/kawax/laravel-google-searchconsole.svg?token=wkkMzzpvNjzrZivG4aGb&branch=master)](https://travis-ci.com/kawax/laravel-google-searchconsole)
[![Maintainability](https://api.codeclimate.com/v1/badges/74439a91df19143ff593/maintainability)](https://codeclimate.com/github/kawax/laravel-google-searchconsole/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/74439a91df19143ff593/test_coverage)](https://codeclimate.com/github/kawax/laravel-google-searchconsole/test_coverage)


https://developers.google.com/webmaster-tools/search-console-api-original/

## Requirements
- PHP >= 7.1.3
- Laravel >= 5.8

## Installation

```
composer require revolution/laravel-google-searchconsole
```

This package depends on

- Socialite
- https://github.com/google/google-api-php-client
- https://github.com/pulkitjalan/google-apiclient

Google_Service_Webmasters  
https://github.com/googleapis/google-api-php-client-services/tree/master/src/Google/Service/Webmasters

### Get API Credentials
from https://developers.google.com/console  
Enable `Google Search Console API`.

### publish config file
```
php artisan vendor:publish --provider="PulkitJalan\Google\GoogleServiceProvider" --tag="config"
```

### config/google.php
```php
    'client_id'        => env('GOOGLE_CLIENT_ID', ''),
    'client_secret'    => env('GOOGLE_CLIENT_SECRET', ''),
    'redirect_uri'     => env('GOOGLE_REDIRECT', ''),
    'scopes'           => [\Google_Service_Webmasters::WEBMASTERS],
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

## Demo
https://github.com/kawax/laravel-searchconsole-project

## Usage
See demo project and docs.

Or another Google API Series.
- https://github.com/kawax/laravel-google-sheets
- https://github.com/kawax/laravel-google-photos

## Query class
Subclass of Google_Service_Webmasters_SearchAnalyticsQueryRequest.

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
    public function init()
    {
        //
    }
}
```

## LICENSE
MIT  

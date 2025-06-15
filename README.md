# Google SearchConsole API for Laravel

https://developers.google.com/webmaster-tools

## Requirements
- PHP >= 8.2
- Laravel >= 11.0

## Installation

```
composer require revolution/laravel-google-searchconsole
```

## Configuration

### Supported authentication methods

- **OAuth 2.0**  
  Recommended for user-based access. Use when you need to access data on behalf of individual Google users.

- **Service Account**  
  Suitable for server-to-server applications. The service account email must be added as an owner or user in Search Console for each property you want to access.

- **API Key is NOT supported**  
  Google Search Console API does not support API Key authentication. You must use OAuth 2.0 or a Service Account.

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

## Basic Usage
```php
use Revolution\Google\SearchConsole\Facades\SearchConsole;
use App\Search\NewQuery;

$query = new NewQuery();
$result = SearchConsole::setAccessToken($token)
                       ->query($url, $query);
```

## LICENSE
MIT

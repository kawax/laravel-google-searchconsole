# Macroable

Extend any method by your self.

## Register in AppServiceProvider.php

```php
use Revolution\Google\SearchConsole\Facades\SearchConsole;

    public function boot()
    {
        SearchConsole::macro('submit', function (string $siteUrl, string $feedpath, array $optParams = []): object {
            return $this->getService()->sitemaps->submit($siteUrl, $feedpath, $optParams)->toSimpleObject();
        });
    }
```

## Use somewhere
```php
$response = SearchConsole::submit($siteUrl, $feedpath);
```

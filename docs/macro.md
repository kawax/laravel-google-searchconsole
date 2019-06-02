# Macroable

Extend any method by your self.

## Register in AppServiceProvider.php

```php
    public function boot()
    {
        \SearchConsole::macro('submit', function ($siteUrl, $feedpath, $optParams = []) {
            return $this->getService()->sitemaps->submit($siteUrl, $feedpath, $optParams)->toSimpleObject();
        });
    }
```

## Use somewhere
```php
$response = SearchConsole::submit($siteUrl, $feedpath);
```

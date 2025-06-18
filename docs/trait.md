# WithSearchConsole Trait

Add `WithSearchConsole` trait to User model.

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Revolution\Google\SearchConsole\Traits\WithSearchConsole;

class User extends Authenticatable
{
    use Notifiable;
    use WithSearchConsole;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the Access Token
     */
    protected function tokenForSearchConsole(): string|array
    {
        return [
            'access_token'  => $this->access_token,
            'refresh_token' => $this->refresh_token,
            'expires_in'    => 3600,
            'created'       => $this->updated_at->getTimestamp(),
        ];
    }
}
```

Add `tokenForSearchConsole()`(abstract) for access_token.

Trait has `searchconsole()` that returns `SearchConsole` instance.

```php
    public function __invoke(Request $request)
    {     
        $sites = $request->user()
                         ->searchconsole()
                         ->listSites();

        $sites = $sites->rows ?? [];

        return view('sites.index')->with(compact('sites'));
    }
```

## Already searchconsole() exists

```php
use WithSearchConsole {
    WithSearchConsole::searchconsole as sc;
}
```

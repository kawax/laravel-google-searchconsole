<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Revolution\Google\SearchConsole\Facades\SearchConsole;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

Artisan::command('sc:test', function () {
    dump(env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION'));
    dump(config('google.service.file'));
    dump(SearchConsole::listSites());
});

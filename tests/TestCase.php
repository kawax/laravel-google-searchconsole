<?php

namespace Tests;

use Revolution\Google\Client\Facades\Google;
use Revolution\Google\Client\Providers\GoogleServiceProvider;
use Revolution\Google\SearchConsole\Facades\SearchConsole;
use Revolution\Google\SearchConsole\Providers\SearchConsoleServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SearchConsoleServiceProvider::class,
            GoogleServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Photos' => SearchConsole::class,
            'Google' => Google::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }
}

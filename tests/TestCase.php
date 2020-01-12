<?php

namespace Revolution\Google\SearchConsole\Tests;

use Revolution\Google\SearchConsole\Providers\SearchConsoleServiceProvider;
use Revolution\Google\SearchConsole\Facades\SearchConsole;

use PulkitJalan\Google\GoogleServiceProvider;
use PulkitJalan\Google\Facades\Google;

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

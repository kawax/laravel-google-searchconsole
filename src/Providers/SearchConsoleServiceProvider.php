<?php

namespace Revolution\Google\SearchConsole\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Revolution\Google\SearchConsole\Contracts\Factory;
use Revolution\Google\SearchConsole\SearchConsoleClient;
use Revolution\Google\SearchConsole\Commands\QueryMakeCommand;

class SearchConsoleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                QueryMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new SearchConsoleClient();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [Factory::class];
    }
}

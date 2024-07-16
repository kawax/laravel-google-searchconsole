<?php

namespace Revolution\Google\SearchConsole\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Revolution\Google\SearchConsole\Commands\QueryMakeCommand;
use Revolution\Google\SearchConsole\Contracts\Factory;
use Revolution\Google\SearchConsole\SearchConsoleClient;

class SearchConsoleServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                QueryMakeCommand::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->singleton(Factory::class, SearchConsoleClient::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [Factory::class];
    }
}

<?php

namespace Revolution\Google\SearchConsole\Facades;

use Illuminate\Support\Facades\Facade;
use Revolution\Google\SearchConsole\Contracts\Factory;

/**
 * @method static Factory setAccessToken($token)
 * @see \Revolution\Google\SearchConsole\SearchConsoleClient
 */
class SearchConsole extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}

<?php

namespace Revolution\Google\SearchConsole\Concerns;

use Illuminate\Container\Container;
use Revolution\Google\SearchConsole\Contracts\Factory;

/**
 * use at User or another model
 */
trait SearchConsole
{
    /**
     * @return Factory
     */
    public function searchconsole()
    {
        $token = $this->tokenForSearchConsole();

        return Container::getInstance()->make(Factory::class)->setAccessToken($token);
    }

    /**
     * Get the Access Token
     *
     * @return string|array
     */
    abstract protected function tokenForSearchConsole();
}

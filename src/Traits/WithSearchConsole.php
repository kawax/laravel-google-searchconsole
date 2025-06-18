<?php

namespace Revolution\Google\SearchConsole\Traits;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Revolution\Google\SearchConsole\Contracts\Factory;

/**
 * use at User or another model.
 */
trait WithSearchConsole
{
    /**
     * @throws BindingResolutionException
     */
    public function searchconsole(): Factory
    {
        $token = $this->tokenForSearchConsole();

        return Container::getInstance()->make(Factory::class)->setAccessToken($token);
    }

    /**
     * Get the Access Token.
     */
    abstract protected function tokenForSearchConsole(): array|string;
}

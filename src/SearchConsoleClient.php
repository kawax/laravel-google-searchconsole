<?php

namespace Revolution\Google\SearchConsole;

use Google\Service;
use Google\Service\Webmasters;
use Illuminate\Container\Container;
use Illuminate\Support\Traits\Macroable;
use PulkitJalan\Google\Client;
use Revolution\Google\SearchConsole\Contracts\Factory;

class SearchConsoleClient implements Factory
{
    use Concerns\SearchAnalytics;
    use Concerns\Sites;
    use Macroable;

    /**
     * @var Webmasters
     */
    protected $service;

    /**
     * @param  Webmasters|Service  $service
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Webmasters
     */
    public function getService(): Webmasters
    {
        return $this->service;
    }

    /**
     * set access_token and set new service.
     *
     * @param  string|array  $token
     * @return $this
     *
     * @throws \Exception
     */
    public function setAccessToken($token)
    {
        /**
         * @var Client $google
         */
        $google = Container::getInstance()->make(Client::class);

        $google->getCache()->clear();

        $google->setAccessToken($token);

        if (isset($token['refresh_token']) and $google->isAccessTokenExpired()) {
            $google->fetchAccessTokenWithRefreshToken();
        }

        return $this->setService($google->make('Webmasters'));
    }

    /**
     * @return array
     */
    public function getAccessToken()
    {
        return $this->getService()->getClient()->getAccessToken();
    }
}

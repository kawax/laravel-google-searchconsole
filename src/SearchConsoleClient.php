<?php

namespace Revolution\Google\SearchConsole;

use Google\Service;
use Google\Service\Webmasters;
use Google\Service\Webmasters\Resource\Searchanalytics;
use Google\Service\Webmasters\Resource\Sites;
use Google\Service\Webmasters\SearchAnalyticsQueryRequest;
use Illuminate\Support\Traits\Macroable;
use Revolution\Google\Client\Facades\Google;
use Revolution\Google\SearchConsole\Contracts\Factory;
use Revolution\Google\SearchConsole\Contracts\Query;

class SearchConsoleClient implements Factory
{
    use Macroable;

    protected Webmasters $service;

    public function __construct()
    {
        $this->setService(Google::make('Webmasters'));
    }

    public function setService(Webmasters|Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getService(): Webmasters
    {
        return $this->service;
    }

    /**
     * set access_token and set new service.
     */
    public function setAccessToken(array|string $token): static
    {
        Google::getCache()->clear();

        Google::setAccessToken($token);

        if (isset($token['refresh_token']) and Google::isAccessTokenExpired()) {
            Google::fetchAccessTokenWithRefreshToken();
        }

        return $this->setService(Google::make('Webmasters'));
    }

    public function getAccessToken(): array
    {
        return $this->getService()->getClient()->getAccessToken();
    }

    public function query(string $url, Query|SearchAnalyticsQueryRequest $query): object
    {
        return $this->serviceSearchAnalytics()->query($url, $query)->toSimpleObject();
    }

    protected function serviceSearchAnalytics(): Searchanalytics
    {
        return $this->getService()->searchanalytics;
    }

    public function listSites(array $optParams = []): object
    {
        return $this->serviceSites()->listSites($optParams)->toSimpleObject();
    }

    protected function serviceSites(): Sites
    {
        return $this->getService()->sites;
    }
}

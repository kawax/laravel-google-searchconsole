<?php

namespace Revolution\Google\SearchConsole\Contracts;

use Google\Service;
use Google\Service\Webmasters;
use Google\Service\Webmasters\SearchAnalyticsQueryRequest;

interface Factory
{
    public function query(string $url, Query|SearchAnalyticsQueryRequest $query): object;

    public function setService(Webmasters|Service $service): static;

    public function getService(): Webmasters;

    /**
     * set access_token and set new service.
     */
    public function setAccessToken(array|string $token): static;

    public function getAccessToken(): array;

    public function listSites(array $optParams = []): object;
}

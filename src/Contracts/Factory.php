<?php

namespace Revolution\Google\SearchConsole\Contracts;

use Google\Service;
use Google\Service\Webmasters;
use Google\Service\Webmasters\SearchAnalyticsQueryRequest;

interface Factory
{
    /**
     * @param  string  $url
     * @param  Query|SearchAnalyticsQueryRequest  $query
     *
     * @return object
     */
    public function query(string $url, $query);

    /**
     * @param  Webmasters|Service  $service
     *
     * @return $this
     */
    public function setService($service);

    /**
     * @return Webmasters
     */
    public function getService(): Webmasters;

    /**
     * set access_token and set new service.
     *
     * @param  string|array  $token
     *
     * @return $this
     * @throws \Exception
     */
    public function setAccessToken($token);

    /**
     * @return array
     */
    public function getAccessToken();

    /**
     * @param  array  $optParams
     *
     * @return object
     */
    public function listSites($optParams = []);
}

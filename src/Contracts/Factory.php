<?php

namespace Revolution\Google\SearchConsole\Contracts;

use Google_Service_Webmasters;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest as QueryRequest;

interface Factory
{
    /**
     * @param  string  $url
     * @param  Query|QueryRequest  $query
     * @return object
     */
    public function query(string $url, $query);

    /**
     * @param  Google_Service_Webmasters|\Google_Service  $service
     * @return $this
     */
    public function setService($service);

    /**
     * @return Google_Service_Webmasters
     */
    public function getService(): Google_Service_Webmasters;

    /**
     * set access_token and set new service.
     *
     * @param  string|array  $token
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
     * @return object
     */
    public function listSites($optParams = []);
}

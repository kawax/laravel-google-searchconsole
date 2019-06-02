<?php

namespace Revolution\Google\SearchConsole\Concerns;

use Google_Service_Webmasters_Resource_Searchanalytics;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest as QueryRequest;
use Revolution\Google\SearchConsole\Contracts\Query;

trait SearchAnalytics
{
    /**
     * @param  string  $url
     * @param  Query|QueryRequest  $query
     * @return object
     */
    public function query(string $url, $query)
    {
        return $this->serviceSearchAnalytics()->query($url, $query)->toSimpleObject();
    }

    /**
     * @return Google_Service_Webmasters_Resource_Searchanalytics
     */
    protected function serviceSearchAnalytics()
    {
        return $this->getService()->searchanalytics;
    }
}

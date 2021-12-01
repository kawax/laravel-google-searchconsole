<?php

namespace Revolution\Google\SearchConsole\Concerns;

use Google\Service\Webmasters\SearchAnalyticsQueryRequest;
use Revolution\Google\SearchConsole\Contracts\Query;

trait SearchAnalytics
{
    /**
     * @param  string  $url
     * @param  Query|SearchAnalyticsQueryRequest  $query
     * @return object
     */
    public function query(string $url, $query)
    {
        return $this->serviceSearchAnalytics()->query($url, $query)->toSimpleObject();
    }

    /**
     * @return \Google\Service\Webmasters\Resource\Searchanalytics
     */
    protected function serviceSearchAnalytics()
    {
        return $this->getService()->searchanalytics;
    }
}

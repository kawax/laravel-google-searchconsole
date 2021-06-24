<?php

namespace Revolution\Google\SearchConsole\Query;

use Google\Service\Webmasters\SearchAnalyticsQueryRequest;
use Revolution\Google\SearchConsole\Contracts\Query;

abstract class AbstractQuery extends SearchAnalyticsQueryRequest implements Query
{
    /**
     * Google_Model gapiInit().
     */
    protected function gapiInit()
    {
        $this->init();
    }

    abstract public function init();
}

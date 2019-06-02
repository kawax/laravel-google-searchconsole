<?php

namespace Revolution\Google\SearchConsole\Query;

use Revolution\Google\SearchConsole\Contracts\Query;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest as QueryRequest;

abstract class AbstractQuery extends QueryRequest implements Query
{
    /**
     * Google_Model gapiInit()
     */
    protected function gapiInit()
    {
        $this->init();
    }

    abstract public function init();
}

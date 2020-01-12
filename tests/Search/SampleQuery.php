<?php

namespace Revolution\Google\SearchConsole\Tests\Search;

use Revolution\Google\SearchConsole\Query\AbstractQuery;

class SampleQuery extends AbstractQuery
{
    public function init()
    {
        $this->setDimensions(['query']);
        $this->setAggregationType(['auto']);
        $this->setRowLimit(100);
    }
}

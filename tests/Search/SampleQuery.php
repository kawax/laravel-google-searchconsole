<?php

namespace Tests\Search;

use Revolution\Google\SearchConsole\Query\AbstractQuery;

class SampleQuery extends AbstractQuery
{
    public function init(): void
    {
        $this->setDimensions(['query']);
        $this->setAggregationType(['auto']);
        $this->setRowLimit(100);
    }
}

<?php

namespace Revolution\Google\SearchConsole\Concerns;

trait Sites
{
    /**
     * {@inheritdoc}
     */
    public function listSites($optParams = [])
    {
        return $this->serviceSites()->listSites($optParams)->toSimpleObject();
    }

    /**
     * @return \Google\Service\Webmasters\Resource\Sites
     */
    protected function serviceSites()
    {
        return $this->getService()->sites;
    }
}

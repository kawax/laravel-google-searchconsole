<?php

namespace Revolution\Google\SearchConsole\Concerns;

use Google_Service_Webmasters_Resource_Sites;

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
     * @return Google_Service_Webmasters_Resource_Sites
     */
    protected function serviceSites()
    {
        return $this->getService()->sites;
    }
}

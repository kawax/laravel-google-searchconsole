<?php

namespace Tests\Integration;

use Mockery as m;
use Revolution\Google\SearchConsole\Facades\SearchConsole;
use Tests\TestCase;

class ServiceAccountTest extends TestCase
{
    public function test_list_sites()
    {
        $sites = SearchConsole::listSites([]);

        $this->assertNotNull($sites);
    }
}

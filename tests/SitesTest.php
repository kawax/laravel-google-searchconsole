<?php

namespace Revolution\Google\SearchConsole\Tests;

use Google_Service_Webmasters;
use Google_Service_Webmasters_Resource_Sites as Sites;
use Mockery as m;
use Revolution\Google\SearchConsole\SearchConsoleClient;

class SitesTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testListSites()
    {
        $sc = m::mock(SearchConsoleClient::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $sc->shouldReceive('serviceSites->listSites->toSimpleObject')->andReturn('test');

        $sites = $sc->listSites([]);

        $this->assertSame('test', $sites);
    }

    public function testServiceSites()
    {
        $service = m::mock(Google_Service_Webmasters::class);
        $service->sites = m::mock(Sites::class);

        $photos = m::mock(SearchConsoleClient::class)->makePartial()->shouldAllowMockingProtectedMethods();

        $sites = $photos->setService($service)->serviceSites();

        $this->assertInstanceOf(Sites::class, $sites);
    }
}

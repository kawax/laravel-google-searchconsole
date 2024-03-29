<?php

namespace Revolution\Google\SearchConsole\Tests;

use Google\Service\Webmasters;
use Google\Service\Webmasters\Resource\Sites;
use Mockery as m;
use Revolution\Google\SearchConsole\SearchConsoleClient;

class SitesTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();

        parent::tearDown();
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
        $service = m::mock(Webmasters::class);
        $service->sites = m::mock(Sites::class);

        $photos = m::mock(SearchConsoleClient::class)->makePartial()->shouldAllowMockingProtectedMethods();

        $sites = $photos->setService($service)->serviceSites();

        $this->assertInstanceOf(Sites::class, $sites);
    }
}

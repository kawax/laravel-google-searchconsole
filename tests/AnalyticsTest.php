<?php

namespace Revolution\Google\SearchConsole\Tests;

use Mockery as m;

use Revolution\Google\SearchConsole\SearchConsoleClient;
use Revolution\Google\SearchConsole\Tests\Search\SampleQuery;
use Google_Service_Webmasters;
use Google_Service_Webmasters_Resource_Searchanalytics as Searchanalytics;

class AnalyticsTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testQuery()
    {
        $sc = m::mock(SearchConsoleClient::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $sc->shouldReceive('serviceSearchAnalytics->query->toSimpleObject')->andReturn('test');

        $url = '';
        $query = new SampleQuery();

        $sites = $sc->query($url, $query);

        $this->assertSame('test', $sites);
    }

    public function testServiceSearchAnalytics()
    {
        $service = m::mock(Google_Service_Webmasters::class);
        $service->searchanalytics = m::mock(Searchanalytics::class);

        $photos = m::mock(SearchConsoleClient::class)->makePartial()->shouldAllowMockingProtectedMethods();

        $sites = $photos->setService($service)->serviceSearchAnalytics();

        $this->assertInstanceOf(Searchanalytics::class, $sites);
    }
}

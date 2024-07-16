<?php

namespace Tests;

use Google\Service\Webmasters;
use Google\Service\Webmasters\Resource\Searchanalytics;
use Mockery as m;
use Revolution\Google\SearchConsole\SearchConsoleClient;
use Tests\Search\SampleQuery;

class AnalyticsTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();

        parent::tearDown();
    }

    public function testQuery()
    {
        $sc = m::mock(SearchConsoleClient::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $sc->shouldReceive('serviceSearchAnalytics->query->toSimpleObject')->andReturn((object) ['test' => 'test']);

        $url = '';
        $query = new SampleQuery();

        $sites = $sc->query($url, $query);

        $this->assertObjectHasProperty('test', $sites);
    }

    public function testServiceSearchAnalytics()
    {
        $service = m::mock(Webmasters::class);
        $service->searchanalytics = m::mock(Searchanalytics::class);

        $photos = m::mock(SearchConsoleClient::class)->makePartial()->shouldAllowMockingProtectedMethods();

        $sites = $photos->setService($service)->serviceSearchAnalytics();

        $this->assertInstanceOf(Searchanalytics::class, $sites);
    }
}

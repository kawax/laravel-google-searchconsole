<?php

namespace Tests;

use Google\Service\Webmasters;
use Mockery as m;
use Revolution\Google\Client\GoogleApiClient;
use Revolution\Google\SearchConsole\Facades\SearchConsole;
use Revolution\Google\SearchConsole\SearchConsoleClient;

class SearchTest extends TestCase
{
    /**
     * @var GoogleApiClient
     */
    protected GoogleApiClient $google;

    protected function setUp(): void
    {
        parent::setUp();

        $this->google = m::mock(GoogleApiClient::class);
        app()->instance(GoogleApiClient::class, $this->google);
    }

    public function tearDown(): void
    {
        m::close();

        parent::tearDown();
    }

    public function testInstance()
    {
        $sc = new SearchConsoleClient();

        $this->assertInstanceOf(SearchConsoleClient::class, $sc);
    }

    public function testService()
    {
        $this->google->shouldReceive('make')->once()->andReturns(m::mock(Webmasters::class));

        SearchConsole::setService($this->google->make('Webmasters'));

        $this->assertInstanceOf(Webmasters::class, SearchConsole::getService());
    }

    public function testSetAccessToken()
    {
        $this->google->shouldReceive('getCache->clear')->once();
        $this->google->shouldReceive('setAccessToken')->once();
        $this->google->shouldReceive('isAccessTokenExpired')->once()->andReturns(true);
        $this->google->shouldReceive('fetchAccessTokenWithRefreshToken')->once();
        $this->google->shouldReceive('make')->once()->andReturns(m::mock(Webmasters::class));

        $sc = SearchConsole::setAccessToken([
            'access_token' => 'test',
            'refresh_token' => 'test',
        ]);

        $this->assertInstanceOf(Webmasters::class, $sc->getService());
    }

    public function testGetAccessToken()
    {
        $sc = m::mock(SearchConsoleClient::class)->makePartial();
        $sc->shouldReceive('getService->getClient->getAccessToken')->andReturn(['token' => 'test']);

        $token = $sc->getAccessToken();

        $this->assertSame(['token' => 'test'], $token);
    }
}

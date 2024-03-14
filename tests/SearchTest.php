<?php

namespace Revolution\Google\SearchConsole\Tests;

use Mockery as m;
use PulkitJalan\Google\Client;
use Revolution\Google\SearchConsole\Facades\SearchConsole;
use Revolution\Google\SearchConsole\SearchConsoleClient;

class SearchTest extends TestCase
{
    /**
     * @var Client
     */
    protected $google;

    protected function setUp(): void
    {
        parent::setUp();

        $this->google = m::mock(Client::class);
        app()->instance(Client::class, $this->google);
    }

    public function tearDown(): void
    {
        m::close();
    }

    public function testInstance()
    {
        $sc = new SearchConsoleClient();

        $this->assertInstanceOf(SearchConsoleClient::class, $sc);
    }

    public function testService()
    {
        $this->google->shouldReceive('make')->once()->andReturns(m::mock(\Google_Service_Webmasters::class));

        SearchConsole::setService($this->google->make('Webmasters'));

        $this->assertInstanceOf(\Google_Service_Webmasters::class, SearchConsole::getService());
    }

    public function testSetAccessToken()
    {
        $this->google->shouldReceive('getCache->clear')->once();
        $this->google->shouldReceive('setAccessToken')->once();
        $this->google->shouldReceive('isAccessTokenExpired')->once()->andReturns(true);
        $this->google->shouldReceive('fetchAccessTokenWithRefreshToken')->once();
        $this->google->shouldReceive('make')->once()->andReturns(m::mock(\Google_Service_Webmasters::class));

        $sc = SearchConsole::setAccessToken([
            'access_token' => 'test',
            'refresh_token' => 'test',
        ]);

        $this->assertInstanceOf(\Google_Service_Webmasters::class, $sc->getService());
    }

    public function testGetAccessToken()
    {
        $sc = m::mock(SearchConsoleClient::class)->makePartial();
        $sc->shouldReceive('getService->getClient->getAccessToken')->andReturn('token');

        $token = $sc->getAccessToken();

        $this->assertSame('token', $token);
    }
}

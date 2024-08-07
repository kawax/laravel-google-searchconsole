<?php

namespace Tests;

use Mockery as m;
use Revolution\Google\SearchConsole\Concerns\SearchConsole as SearchConsoleTrait;
use Revolution\Google\SearchConsole\Facades\SearchConsole;

class TraitTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();

        parent::tearDown();
    }

    public function testTrait()
    {
        SearchConsole::shouldReceive('setAccessToken')->with('test')->once()->andReturn(m::self());

        $sc = (new User())->searchconsole();

        $this->assertNotNull($sc);
    }
}

class User
{
    use SearchConsoleTrait;

    public function tokenForSearchConsole(): array|string
    {
        return 'test';
    }
}

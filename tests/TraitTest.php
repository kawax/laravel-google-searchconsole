<?php

namespace Tests;

use Mockery as m;

use Revolution\Google\SearchConsole\Facades\SearchConsole;
use Revolution\Google\SearchConsole\Concerns\SearchConsole as SearchConsoleTrait;

class TraitTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testTrait()
    {
        SearchConsole::shouldReceive('setAccessToken')->with('test')->once()->andReturn(m::self());

        $sc = (new class
        {
            use SearchConsoleTrait;

            public function tokenForSearchConsole()
            {
                return 'test';
            }
        })->searchconsole();

        $this->assertNotNull($sc);
    }
}

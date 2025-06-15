<?php

namespace Tests\Feature;

use Mockery as m;
use Revolution\Google\SearchConsole\Concerns\SearchConsole as SearchConsoleTrait;
use Revolution\Google\SearchConsole\Facades\SearchConsole;
use Tests\TestCase;

class TraitTest extends TestCase
{
    protected function tearDown(): void
    {
        m::close();

        parent::tearDown();
    }

    public function test_trait()
    {
        SearchConsole::shouldReceive('setAccessToken')->with('test')->once()->andReturn(m::self());

        $sc = (new User)->searchconsole();

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

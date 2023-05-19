<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{

    public function testConfig()
    {
            $firstName = config("contoh.author.first");
            $firstName2 = Config::get("contoh.author.first");
            self::assertEquals($firstName, $firstName2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName = $config->get("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");
        self::assertEquals($firstName, $firstName2);
    }

    public function testConfigMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('John');
        $firstName = Config::get("contoh.author.first");
        self::assertEquals('John', $firstName);
    }

}

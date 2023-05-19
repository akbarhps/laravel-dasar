<?php

namespace Tests\Feature;

use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnvironmentVariable()
    {
        $env = Env::get("name", "John Doe");
        $this->assertEquals("John Doe", $env);
    }
}

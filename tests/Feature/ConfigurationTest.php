<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $first = config('contoh.author.first');
        $last = config('contoh.author.last');
        $email = config('contoh.email');
        $website = config('contoh.website');

        self::assertEquals('John', $first);
        self::assertEquals('Doe', $last);
        self::assertEquals('johndoe@gmail.com', $email);
        self::assertEquals('https://johndoe.com', $website);
    }

}

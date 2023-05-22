<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLFull()
    {
        $this->get('/url/full?name=John')
            ->assertSeeText('http://localhost/url/full?name=John');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/John');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }


}

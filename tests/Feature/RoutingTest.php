<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutingTest extends TestCase
{

    public function testGet()
    {
        $this->get('/hello')
            ->assertStatus(200)
            ->assertSeeText('Hai');
    }

    public function testRedirect()
    {
        $this->get('/hi')
            ->assertStatus(302)
            ->assertRedirect('/hello');
    }

    public function testFallback()
    {
        $this->get('/notfound')
            ->assertStatus(200)
            ->assertSeeText('404 Not Found');
    }

}

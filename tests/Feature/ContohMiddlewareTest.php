<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testMiddlewareValid()
    {
        $this->withHeaders([
            'X-API-KEY' => 'api',
        ])
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('OK');
    }

    public function testMiddlewareInvalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testMiddlewareGroupValid()
    {
        $this->withHeaders([
            'X-API-KEY' => 'api',
        ])
            ->get('/middleware/group')
            ->assertStatus(200)
            ->assertSeeText('GROUP');
    }

    public function testMiddlewareGroupInvalid()
    {
        $this->get('/middleware/group')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }
}

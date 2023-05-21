<?php

namespace Tests\Feature;

use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertStatus(200)
            ->assertCookie('User-Id', 'John')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'John')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertStatus(200)
            ->assertJson([
                'userId' => 'John',
                'isMember' => 'true'
            ]);
    }

    public function testClearCookie()
    {
        $this->withCookie('User-Id', 'John')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/clear')
            ->assertStatus(200)
            ->assertCookieExpired('User-Id')
            ->assertCookieExpired('Is-Member');
    }


}

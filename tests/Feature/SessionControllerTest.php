<?php

namespace Tests\Feature;

use Tests\TestCase;

class SessionControllerTest extends TestCase
{

    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'John')
            ->assertSessionHas('isMember', true);
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'John',
            'isMember' => true
        ])
            ->get('/session/get')
            ->assertSeeText('User ID: John, isMember: 1');
    }

}

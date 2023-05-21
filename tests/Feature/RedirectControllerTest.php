<?php

namespace Tests\Feature;

use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/redirect/from')
            ->assertStatus(302)
            ->assertRedirect('/redirect/to');
    }

    public function testRedirectName()
    {
        $this->get('/redirect/name')
            ->assertStatus(302)
            ->assertRedirect('/redirect/name/John');
    }

    public function testRedirectAction()
    {
        $this->get('/redirect/action')
            ->assertStatus(302)
            ->assertRedirect('/redirect/name/John');
    }

    public function testRedirectAway()
    {
        $this->get('/redirect/away')
            ->assertStatus(302)
            ->assertRedirect('https://google.com');
    }


}

<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResponseControllerTest extends TestCase
{

    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'John Doe')
            ->assertHeader('App', 'Laravel Gemink')
            ->assertJson([
                'firstName' => 'John',
                'lastName' => 'Doe'
            ]);
    }

    public function testResponseView()
    {
        $this->get('/response/type/view')
            ->assertStatus(200)
            ->assertViewIs('hello')
            ->assertViewHas('name', 'John Doe');
    }

    public function testResponseJSON()
    {
        $this->get('/response/type/json')
            ->assertStatus(200)
            ->assertJson([
                'firstName' => 'John',
                'lastName' => 'Doe'
            ]);
    }

    public function testResponseFile()
    {
        $this->get('/response/type/file')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testResponseDownload()
    {
        $this->get('/response/type/download')
            ->assertStatus(200)
            ->assertDownload('avatar.jpg');
    }

}

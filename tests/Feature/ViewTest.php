<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViewTest extends TestCase
{

    public function testView()
    {
        $this->get('/hello-view')
            ->assertSeeText('Hello, John Doe');
    }

    public function testNestedView()
    {
        $this->get('/world')
            ->assertSeeText('World, John Doe');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'John Doe'])
            ->assertSeeText('Hello, John Doe');

        $this->view('hello.world', ['name' => 'John Doe'])
            ->assertSeeText('World, John Doe');
    }


}

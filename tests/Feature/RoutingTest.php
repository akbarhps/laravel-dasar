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

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertStatus(200)
            ->assertSeeText('Product ID: 1');

        $this->get('/products/1/items/2')
            ->assertStatus(200)
            ->assertSeeText('Product ID: 1, Items: 2');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1')
            ->assertStatus(200)
            ->assertSeeText('Category ID: 1');

        $this->get('/categories/abc')
            ->assertStatus(200)
            ->assertSeeText('404 Not Found');
    }

    public function testRouteOptionalParameter()
    {
        $this->get('/users/')
            ->assertStatus(200)
            ->assertSeeText('User ID: 404');

        $this->get('/users/1')
            ->assertStatus(200)
            ->assertSeeText('User ID: 1');
    }

    public function testRoutingConflict()
    {
        $this->get('/conflict/hello')
            ->assertStatus(200)
            ->assertSeeText('Conflict Hello World');

        $this->get('/conflict/john')
            ->assertStatus(200)
            ->assertSeeText('Conflict john');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/1')
            ->assertStatus(200)
            ->assertSeeText('/products/1');

        $this->get('/product-redirect/1')
            ->assertStatus(302)
            ->assertRedirect('/products/1');
    }


}

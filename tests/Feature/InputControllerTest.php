<?php

namespace Tests\Feature;

use Tests\TestCase;

class InputControllerTest extends TestCase
{

    public function testInput()
    {
        $this->get('/input/hello?name=John Doe')
            ->assertStatus(200)
            ->assertSeeText('Hello John Doe');

        $this->post('/input/hello', [
            'name' => 'John Doe'
        ])
            ->assertStatus(200)
            ->assertSeeText('Hello John Doe');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'John',
                'last' => 'Doe'
            ]
        ])
            ->assertStatus(200)
            ->assertSeeText('Hello John');
    }

    public function testFullInput()
    {
        $this->post('/input/hello/input', [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => '123456',
            'address' => [
                'country' => 'Indonesia',
                'city' => 'Jakarta'
            ]
        ])
            ->assertStatus(200)
            ->assertJson([
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'password' => '123456',
                'address' => [
                    'country' => 'Indonesia',
                    'city' => 'Jakarta'
                ]
            ]);
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Product 1',
                    'price' => 10000
                ],
                [
                    'name' => 'Product 2',
                    'price' => 20000
                ]
            ]
        ])
            ->assertStatus(200)
            ->assertJson([
                'Product 1',
                'Product 2',
            ]);
    }

    public function testInputType()
    {
        $this->post('/input/hello/type', [
            'name' => 'John Doe',
            'married' => 'true',
            'birth_date' => '1990-01-01'
        ])
            ->assertStatus(200)
            ->assertJson([
                'name' => 'John Doe',
                'married' => true,
                'birth_date' => '1990-01-01'
            ]);
    }

    public function testInputFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'John',
                'middle' => 'Awek awek',
                'last' => 'Doe'
            ],
            'email' => 'john@gmail.com',
            'password' => '123456',
            'address' => [
                'country' => 'Indonesia',
                'city' => 'Jakarta'
            ]])
            ->assertStatus(200)
            ->assertJson([
                'name' => [
                    'first' => 'John',
                    'last' => 'Doe'
                ]
            ]);
    }

    public function testInputFilterExcept()
    {
        $this->post('/input/filter/except', [
            'name' => [
                'first' => 'John',
                'last' => 'Doe'
            ],
            'email' => 'john@gmail.com',
            'password' => '123456',
            'admin' => true
        ])
            ->assertStatus(200)
            ->assertJson([
                'name' => [
                    'first' => 'John',
                    'last' => 'Doe'
                ],
                'email' => 'john@gmail.com',
                'password' => '123456',
            ]);
    }

    public function testInputFilterMerge()
    {
        $this->post('/input/filter/merge', [
            'name' => [
                'first' => 'John',
                'last' => 'Doe'
            ],
            'email' => 'john@gmail.com',
            'password' => '123456',
            'admin' => true
        ])
            ->assertStatus(200)
            ->assertJson([
                'name' => [
                    'first' => 'John',
                    'last' => 'Doe'
                ],
                'email' => 'john@gmail.com',
                'password' => '123456',
                'admin' => false,
            ]);

        $this->post('/input/filter/merge', [
            'name' => [
                'first' => 'John',
                'last' => 'Doe'
            ],
            'email' => 'john@gmail.com',
            'password' => '123456',
        ])
            ->assertStatus(200)
            ->assertJson([
                'name' => [
                    'first' => 'John',
                    'last' => 'Doe'
                ],
                'email' => 'john@gmail.com',
                'password' => '123456',
                'admin' => false,
            ]);
    }


}

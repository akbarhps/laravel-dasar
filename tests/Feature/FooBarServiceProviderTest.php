<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo, $foo2);

        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar, $bar2);

        self::assertSame($foo, $bar->foo);
        self::assertSame($foo2, $bar2->foo);
    }

    public function testPropertySingleton()
    {
        $helloService = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertSame($helloService, $helloService2);
        self::assertEquals('Halo world', $helloService->hello('world'));
    }


}

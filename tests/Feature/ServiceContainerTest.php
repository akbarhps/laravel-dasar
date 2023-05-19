<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection()
    {
//        $foo = new Foo();
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("foo", $foo->foo());
        self::assertEquals("foo", $foo2->foo());
        self::assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
//        $person = $this->app->make(Person::class);
//        self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person("John", "Doe");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("John", $person->firstName);
        self::assertEquals("Doe", $person->lastName);

        self::assertNotSame($person, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("John", "Doe");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("John", $person->firstName);
        self::assertEquals("Doe", $person->lastName);

        self::assertSame($person, $person2);
    }

    public function testInstance()
    {
        $person = new Person("John", "Doe");
        $this->app->instance(Person::class, $person);

        $person2 = $this->app->make(Person::class);
        $person3 = $this->app->make(Person::class);

        self::assertEquals("John", $person2->firstName);
        self::assertEquals("Doe", $person2->lastName);

        self::assertSame($person2, $person3);
    }

    public function testDependencyInjection2()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testDependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $bar = $this->app->make(bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar, $bar2);
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        self::assertInstanceOf(HelloServiceIndonesia::class, $helloService);
        self::assertEquals("Halo akbar", $helloService->hello("akbar"));
    }


}

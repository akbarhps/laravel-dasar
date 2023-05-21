<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $fileSystem = Storage::disk('local');
        $fileSystem->put('test.txt', 'Hello World');
        $this->assertTrue($fileSystem->exists('test.txt'));

        $content = $fileSystem->get('test.txt');
        $this->assertEquals('Hello World', $content);

//        $fileSystem->delete('test.txt');
    }

}

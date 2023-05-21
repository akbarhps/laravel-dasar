<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{

    public function testEncrypt()
    {
        $encrypt = Crypt::encrypt('Hello World');
        $this->assertIsString($encrypt);

        $decrypt = Crypt::decrypt($encrypt);
        $this->assertEquals('Hello World', $decrypt);
    }

}

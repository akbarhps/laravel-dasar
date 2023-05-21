<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        $image = UploadedFile::fake()->image('avatar.jpg');
        $this->post('/file/upload', [
            'image' => $image,
        ])->assertSeeText("OK avatar.jpg");
    }

}

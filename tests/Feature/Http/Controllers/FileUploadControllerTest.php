<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadControllerTest extends TestCase
{
    public function testUploadsFileSuccessfully(): void
    {
        Storage::fake('local');

        $this
            ->post(route('upload'), [
                'file' => UploadedFile::fake()->image('image.jpg'),
            ])
            ->assertOk(); // not possible to assert the response body :(
    }
}

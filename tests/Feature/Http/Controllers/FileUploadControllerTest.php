<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadControllerTest extends TestCase
{
    public function testUploadsFileSuccessfully(): void
    {
        $file = UploadedFile::fake()->image('image.jpg');

        $filesystem = $this->mock(Filesystem::class);
        $filesystem->shouldReceive('putFile')
            ->once()
            ->withArgs(fn (UploadedFile $uploadedFile): bool => $uploadedFile->getPath() === $file->getPath())
            ->andReturn('fake-avatar.jpg');

        $this
            ->post(route('upload'), [
                'file' => $file,
            ])
            ->assertOk()
            ->assertExactJson(['path' => 'fake-avatar.jpg']);
    }

    public function testHandlesFailedFileUploads(): void
    {
        $filesystem = $this->mock(Filesystem::class);
        $filesystem->shouldReceive('putFile')->once()->andReturnFalse();

        $this
            ->post(route('upload'), [
                'file' => UploadedFile::fake()->image('image.jpg'),
            ])
            ->assertBadRequest();
    }
}

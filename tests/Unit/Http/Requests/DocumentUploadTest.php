<?php

namespace Tests\Unit\Http\Requests;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DocumentUploadTest extends TestCase
{

    public function itValidatesFileSize()
    {
        $file = UploadedFile::fake()->create('large-file.json', 10241);

        $response = $this->withoutMiddleware()->post(route('upload'), [
            'file' => $file,
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['file']);
        $response->assertSessionHasErrors([
            'file' => 'O arquivo não pode ser maior que 10MB.',
        ]);
    }

    public function itValidatesFileType()
    {
        $file = UploadedFile::fake()->image('file.jpg');
        $response = $this->withoutMiddleware()->post(route('upload'), [
            'file' => $file,
        ]);

        $response->assertSessionHasErrors('file.mimes');
    }
}

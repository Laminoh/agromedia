<?php

namespace Tests\Feature;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class MediaStorageTest extends TestCase
{
    public function test_media_url_uses_the_configured_media_disk(): void
    {
        Storage::fake('public');
        config(['filesystems.media_disk' => 'public']);
        URL::forceRootUrl('http://localhost/agromedia/public');

        $media = new Media(['path' => 'products/images/tomato.jpg']);

        $this->assertSame(
            'http://localhost/agromedia/public/storage/products/images/tomato.jpg',
            $media->url,
        );
    }
}

<?php

namespace Tests\Feature;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaStorageTest extends TestCase
{
    public function test_media_url_uses_the_configured_media_disk(): void
    {
        Storage::fake('public');
        config(['filesystems.media_disk' => 'public']);

        $media = new Media(['path' => 'products/images/tomato.jpg']);

        $this->assertSame(
            Storage::disk('public')->url('products/images/tomato.jpg'),
            $media->url,
        );
    }
}

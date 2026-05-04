<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;

trait HasPublicImages
{
    private const PUBLIC_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];

    protected function publicImageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (! in_array($extension, self::PUBLIC_IMAGE_EXTENSIONS, true)) {
            return null;
        }

        return Storage::url($path);
    }
}

<?php

namespace App\Listeners;

use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ConvertProductImageToWebp
{
    /**
     * Handle the event.
     */
    public function handle(MediaHasBeenAddedEvent $event): void
    {
        $media = $event->media;

        // Check if file is an image
        if (!$media->mime_type || !str_starts_with($media->mime_type, 'image/')) {
            return;
        }

        // Avoid infinite loop if already converted to webp
        if ($media->mime_type === 'image/webp' && str_ends_with(strtolower($media->file_name), '.webp')) {
            return;
        }

        $originalPath = $media->getPath();

        if (!File::exists($originalPath)) {
            return;
        }

        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->decodePath($originalPath);

            $pathInfo = pathinfo($media->file_name);
            $newFileName = $pathInfo['filename'] . '.webp';
            $directory = dirname($originalPath);
            $newPath = $directory . '/' . $newFileName;

            // Compress & convert to WebP (quality 80)
            $encoded = $image->encodeUsingFileExtension('webp', quality: 80);
            $encoded->save($newPath);

            // Delete original file if filename changed
            if ($originalPath !== $newPath && File::exists($originalPath)) {
                File::delete($originalPath);
            }

            // Update media metadata silently
            $media->file_name = $newFileName;
            $media->name = $pathInfo['filename'];
            $media->mime_type = 'image/webp';
            $media->size = File::size($newPath);
            $media->saveQuietly();

            Log::info("Converted media ID {$media->id} ({$media->file_name}) to WebP format.");
        } catch (\Throwable $e) {
            Log::error("Failed converting media ID {$media->id} to WebP: " . $e->getMessage());
        }
    }
}

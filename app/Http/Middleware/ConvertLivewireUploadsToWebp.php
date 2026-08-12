<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ConvertLivewireUploadsToWebp
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only process Livewire file upload endpoint responses
        if (!$request->is('livewire/upload-file*') || !$response->isSuccessful()) {
            return $response;
        }

        try {
            $disk = config('livewire.temporary_file_upload.disk') ?: config('filesystems.default');
            $storage = Storage::disk($disk);
            $manager = new ImageManager(new Driver());

            $content = json_decode($response->getContent(), true);

            if (isset($content['paths']) && is_array($content['paths'])) {
                $tmpDirectory = config('livewire.temporary_file_upload.directory') ?: 'livewire-tmp';

                foreach ($content['paths'] as $relativePath) {
                    $fullPath = $storage->path($tmpDirectory . '/' . ltrim($relativePath, '/'));

                    if (File::exists($fullPath)) {
                        $mime = File::mimeType($fullPath);

                        if ($mime && str_starts_with($mime, 'image/')) {
                            // Convert and compress temporary uploaded file directly to WebP
                            $image = $manager->decodePath($fullPath);
                            $encoded = $image->encodeUsingFileExtension('webp', quality: 80);
                            $encoded->save($fullPath);

                            Log::info("Compressed Livewire temporary upload to WebP: {$fullPath}");
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::error("Error converting Livewire upload to WebP: " . $e->getMessage());
        }

        return $response;
    }
}

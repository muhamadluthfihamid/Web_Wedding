<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageCompressor
{
    /**
     * Compress and save uploaded image file using GD (if available) or fallback to normal storage.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int $maxWidth
     * @param int $quality
     * @return string Relative storage path
     */
    public static function compressAndStore(UploadedFile $file, string $folder = 'uploads', int $maxWidth = 1200, int $quality = 80): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '_' . time() . '.' . ($extension === 'png' ? 'png' : 'jpg');
        $destinationPath = storage_path('app/public/' . $folder);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fullPath = $destinationPath . '/' . $filename;

        // Check if GD extension is available for image compression
        if (extension_loaded('gd')) {
            try {
                $image = null;
                if (in_array($extension, ['jpg', 'jpeg'])) {
                    $image = @imagecreatefromjpeg($file->getRealPath());
                } elseif ($extension === 'png') {
                    $image = @imagecreatefrompng($file->getRealPath());
                } elseif ($extension === 'webp') {
                    $image = @imagecreatefromwebp($file->getRealPath());
                }

                if ($image) {
                    $width = imagesx($image);
                    $height = imagesy($image);

                    if ($width > $maxWidth) {
                        $newWidth = $maxWidth;
                        $newHeight = (int) floor($height * ($maxWidth / $width));
                        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

                        // Preserve transparency for PNG
                        if ($extension === 'png') {
                            imagealphablending($resizedImage, false);
                            imagesavealpha($resizedImage, true);
                        }

                        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagedestroy($image);
                        $image = $resizedImage;
                    }

                    if ($extension === 'png') {
                        imagepng($image, $fullPath, 7);
                    } else {
                        imagejpeg($image, $fullPath, $quality);
                    }

                    imagedestroy($image);
                    return $folder . '/' . $filename;
                }
            } catch (\Throwable $e) {
                // Fallback to normal store if GD processing fails
            }
        }

        // Standard Store Fallback
        return $file->store($folder, 'public');
    }
}

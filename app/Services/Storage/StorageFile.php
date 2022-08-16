<?php

namespace App\Services\Storage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageFile
{
    /**
     * @param UploadedFile $file
     * @param string $fileName
     * @return string
     */
    public function uploadPublicFile(UploadedFile $file, string $fileName): string
    {
        $fileName = Storage::disk('s3')->put($fileName, $file);

        return Storage::disk('s3')->url($fileName);
    }

    /**
     * @param string $fileUrl
     * @param string $fileName
     * @return string
     */
    public function uploadPublicFileFromUrl(string $fileUrl, string $fileName): string
    {
        $fileContent = file_get_contents($fileUrl);
        Storage::disk('s3')->put($fileName, $fileContent, 'public');

        return Storage::disk('s3')->url($fileName);
    }

    /**
     * @param UploadedFile $file
     * @param string $fileName
     * @return string
     */
    public function uploadPrivateFile(UploadedFile $file, string $fileName): string
    {
        $fileName = Storage::disk('s3')->put($fileName, $file->getContent(), 'private');

        return Storage::disk('s3')->url($fileName);
    }

    /**
     * Generate full url for file.
     *
     * @param string $fileName
     * @return string
     */
    public function generateFullUrlFile(string $fileName): string
    {
        return Storage::disk('s3')->temporaryUrl($fileName, now()->addMinutes(5));
    }
}

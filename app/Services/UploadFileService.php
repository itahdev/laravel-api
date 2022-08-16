<?php

namespace App\Services;

use App\Http\Requests\UploadFileRequest;
use Carbon\Carbon;
use App\Services\Storage\StorageFile;

class UploadFileService
{
    /**
     * @var StorageFile
     */
    private StorageFile $storageFile;

    public function __construct(StorageFile $storageFile)
    {
        $this->storageFile = $storageFile;
    }

    /**
     * @param UploadFileRequest $request
     * @return string
     */
    public function upload(UploadFileRequest $request): string
    {
        $file = $request->file('file');
        $fileName = 'public';

        return $this->storageFile->uploadPublicFile($file, $fileName);
    }

    /**
     * @param string $path
     * @return string
     */
    public function fullPath(string $path): string
    {
        return $this->storageFile->generateFullUrlFile($path);
    }
}

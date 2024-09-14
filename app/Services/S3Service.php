<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class S3Service
{
    public function uploadFile(string $folder, UploadedFile $file, string $filenameWithoutExtension): string
    {
        $fileName = $filenameWithoutExtension . "." . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $fileName);
    }

    public function getPreSignedUrl(string $url): string
    {
        $expiration = now()->addMinutes(10);

        return Storage::disk('s3')->temporaryUrl($url, $expiration);
    }
}

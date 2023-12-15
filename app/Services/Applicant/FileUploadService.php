<?php

namespace App\Services\Applicant;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
	public static function uploadFile($file, $path)
	{
        if (!is_null($file)) {
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '_' . Str::slug($fileName) . '.' . $file->extension();
            Storage::disk('public')->put($path . $fileName, File::get($file));
            return 'storage/' . $path . $fileName;
        }
	}
}
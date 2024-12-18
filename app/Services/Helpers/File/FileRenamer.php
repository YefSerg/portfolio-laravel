<?php

namespace App\Services\Helpers\File;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class FileRenamer
{
    public static function rename(UploadedFile $file): string
    {
        return md5(Carbon::now().'_'.$file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
    }
}

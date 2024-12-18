<?php

namespace App\Services\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    public function loremImage(string $dir = '', int $width = 320, int $height = 240): string
    {
        $name = $dir.'/'.md5(uniqid(rand(), true)).'.jpg';

        Storage::disk('image')->put(
            $name,
            file_get_contents('https://loremflickr.com/'.$width.'/'.$height)
        );

        return $name;
    }
}

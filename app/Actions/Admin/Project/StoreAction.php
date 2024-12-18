<?php

namespace App\Actions\Admin\Project;

use App\Models\Project;
use App\Services\Helpers\File\FileRenamer;
use Illuminate\Support\Facades\Storage;

class StoreAction
{
    public function __invoke(array $data): Project
    {
        $image = $data['image'];

        $newImageName = FileRenamer::rename($image);
        $data['image'] = Storage::disk('image')->putFileAs('projects', $image, $newImageName);

        return Project::query()->create($data);
    }
}

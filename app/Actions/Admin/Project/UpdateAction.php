<?php

namespace App\Actions\Admin\Project;

use App\Contracts\Actions\Admin\Project\UpdateActionContract;
use App\Models\Project;
use App\Services\Helpers\File\FileRenamer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateAction implements UpdateActionContract
{
    /** @noinspection PhpUnusedLocalVariableInspection */
    public function __invoke(Project $project, array $data): Project
    {
        try {
            DB::beginTransaction();
            $project = $this->update($project, $data);
            DB::commit();

            return $project;
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }

    }

    private function update(Project $project, array $data): Project
    {
        $data = $this->changeImageIfExist($project, $data);

        $project->update($data);

        return $project;
    }

    private function changeImageIfExist(Project $project, array $data): array
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $newImageName = FileRenamer::rename($image);

            Storage::disk('image')->delete($project->image);
            $data['image'] = Storage::disk('image')->putFileAs('projects', $image, $newImageName);
        }

        return $data;
    }
}

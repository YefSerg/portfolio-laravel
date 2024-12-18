<?php

namespace App\Actions\Admin\Project;

use App\Contracts\Actions\Admin\Project\DestroyActionContract;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DestroyAction implements DestroyActionContract
{
    /** @noinspection PhpUnusedLocalVariableInspection */
    public function __invoke(Project $project): void
    {
        try {
            DB::beginTransaction();
            $this->destroy($project);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }

    }

    private function destroy(Project $project): void
    {
        Storage::disk('image')->delete($project->image);
        $project->delete();
    }
}

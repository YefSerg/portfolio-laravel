<?php

namespace Tests\Feature\Actions\Admin\Project;

use App\Contracts\Actions\Admin\Project\DestroyActionContract;
use App\Contracts\Actions\Admin\Project\StoreActionContract;
use App\Models\Project;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DestroyActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @throws ErrorException
     */
    public function test_destroy_project_action(): void
    {
        $this->withoutDeprecationHandling();

        Storage::fake('image');
        $file = File::create('my_image.jpg');

        $data = Project::factory()->withTestImage()->make()->toArray();
        $data['image'] = $file;

        $actionStore = app(StoreActionContract::class);
        $project = $actionStore($data);

        $actionDestroy = app(DestroyActionContract::class);
        $actionDestroy($project);

        $this->assertSoftDeleted('projects', $project->toArray());

        Storage::disk('image')->assertMissing($project->image);
    }
}

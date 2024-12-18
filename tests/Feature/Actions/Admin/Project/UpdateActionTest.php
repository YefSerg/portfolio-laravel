<?php

namespace Tests\Feature\Actions\Admin\Project;

use App\Contracts\Actions\Admin\Project\UpdateActionContract;
use App\Models\Project;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @throws ErrorException
     */
    public function test_update_project_action(): void
    {
        $this->withoutDeprecationHandling();

        $project = Project::factory()->withTestImage()->create();
        $oldImage = $project->image;


        Storage::fake('image');
        $file = File::create('my_new_image.jpg');

        $data = Project::factory()->make()->toArray();

        $data['image'] = $file;

        $action = app(UpdateActionContract::class);
        $updatedProject = $action($project, $data);

        $data['image'] = $updatedProject->image;

        $this->assertDatabaseCount('projects', 1);
        $this->assertDatabaseHas('projects', $data);

        Storage::disk('image')->assertExists($data['image']);
        Storage::disk('image')->assertMissing($oldImage);

    }
}

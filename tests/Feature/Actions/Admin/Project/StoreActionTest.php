<?php

namespace Tests\Feature\Actions\Admin\Project;

use App\Contracts\Actions\Admin\Project\StoreActionContract;
use App\Models\Project;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @throws ErrorException
     */
    public function test_store_project_action(): void
    {
        $this->withoutDeprecationHandling();

        Storage::fake('image');
        $file = File::create('my_image.jpg');

        $data = Project::factory()->withTestImage()->make()->toArray();
        $data['image'] = $file;

        $action = app(StoreActionContract::class);
        $project = $action($data);

        $data['image'] = $project->image;

        $this->assertDatabaseCount('projects', 1);
        $this->assertDatabaseHas('projects', $data);

        Storage::disk('image')->assertExists($data['image']);

    }
}

<?php

namespace Tests\Feature\Controllers\Admin\Project;

use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    private Project $project;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->project = Project::factory()->withTestImage()->create();
        $this->user = User::factory()->create(['role' => UserRoles::ADMIN]);
    }

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_project_update(): void
    {
        $this->withoutDeprecationHandling();

        $data = Project::factory()->withTestImage()->make()->toArray();
        Storage::fake('image');
        $file = File::create('my_image.jpg');
        $data['image'] = $file;

        $response = $this->actingAs($this->user)->patch(route('admin.project.update', ['project' => $this->project]), $data);

        $response->assertFound();
        $response->assertRedirect(route('admin.project.show', ['project' => $this->project]));
    }

    public function test_validation_for_update_project_fails(): void
    {
        $data = [
            'title' => null,
            'description' => null,
            'image' => 'image',
            'category_id' => null,
        ];

        $response = $this->actingAs($this->user)->patch(route('admin.project.update', ['project' => $this->project]), $data);

        $response->assertSessionHasErrors(array_keys($data));
        $response->assertRedirect();
        $response->assertInvalid(array_keys($data));

        $this->assertDatabaseMissing('projects', $data);
    }

    public function test_validation_for_update_project_unique_title_fails(): void
    {
        $category = Category::factory()->create();
        $newProject = Project::factory()->withTestImage()->create();

        Storage::fake('image');
        $file = File::create('my_image.jpg');

        $data = [
            'title' => $newProject->title,
            'description' => 'Description',
            'image' => $file,
            'category_id' => $category->id,
        ];

        $response = $this->actingAs($this->user)->patch(route('admin.project.update', ['project' => $this->project]), $data);
        $response->assertSessionHasErrors('title');
        $response->assertRedirect();
        $response->assertInvalid('title');
    }
}

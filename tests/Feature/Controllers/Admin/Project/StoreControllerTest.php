<?php

namespace Tests\Feature\Controllers\Admin\Project;

use App\Enums\UserRoles;
use App\Models\Project;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => UserRoles::ADMIN]);
    }

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_project_store(): void
    {
        $this->withoutDeprecationHandling();

        $data = Project::factory()->withTestImage()->make()->toArray();

        Storage::fake('image');

        $file = File::create('my_image.jpg');
        $data['image'] = $file;

        $response = $this->actingAs($this->user)->post(route('admin.project.store'), $data);

        $response->assertFound();
        $response->assertRedirect(route('admin.project.index'));
    }

    public function test_validation_for_store_project_fails(): void
    {
        $data = [
            'title' => null,
            'description' => null,
            'image' => null,
            'category_id' => null,
        ];

        $response = $this->actingAs($this->user)->post(route('admin.project.store'), $data);

        $response->assertSessionHasErrors(array_keys($data));
        $response->assertRedirect();
        $response->assertInvalid(array_keys($data));

        $this->assertDatabaseMissing('projects', $data);
    }

    public function test_validation_for_store_project_unique_title_fails(): void
    {
        Storage::fake('image');
        $file = File::create('my_image.jpg');

        $data = [
            'title' => 'Title 1',
            'description' => 'Description',
            'image' => 'image.jpg',
        ];

        Project::factory()->create($data);

        $data['image'] = $file;

        $response = $this->actingAs($this->user)->post(route('admin.project.store'), $data);
        $response->assertSessionHasErrors(['title']);
        $response->assertRedirect();
        $response->assertInvalid(['title']);

        $this->assertDatabaseCount('projects', 1);
    }
}

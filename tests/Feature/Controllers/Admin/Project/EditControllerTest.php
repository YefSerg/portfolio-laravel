<?php

namespace Tests\Feature\Controllers\Admin\Project;

use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EditControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_project_edit_with_view_admin_project_edit(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $project = Project::factory()->withTestImage()->create();
        $categories = Category::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('admin.project.edit', compact('project')));

        $response->assertOk();
        $response->assertSee($project->title);
        $response->assertSee($project->description);
        $response->assertSee($project->image);
        $response->assertSee($project->category_id);

        $response->assertSeeInOrder($categories->pluck('id')->toArray());
        $response->assertSeeInOrder($categories->pluck('title')->toArray());

        $response->assertViewIs('admin.project.edit');
    }
}

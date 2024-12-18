<?php

namespace Tests\Feature\Controllers\Admin\Project;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\UserRoles;
use App\Models\Project;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_project_show_with_view_admin_project_show(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $project = Project::factory()->withTestImage()->create();

        $response = $this->actingAs($user)->get(route('admin.project.show', $project));

        $response->assertStatus(200);
        $response->assertViewIs('admin.project.show');
        $response->assertViewHas('project', $project);
        $response->assertSee('Show project');
        $response->assertSee($project->id);
        $response->assertSee($project->title);
        $response->assertSee($project->image);
        $response->assertSee($project->description);
    }
}

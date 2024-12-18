<?php

namespace Tests\Feature\Controllers\Admin\Project;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\PageSettings;
use App\Enums\UserRoles;
use App\Models\Project;
use App\Models\User;
use ErrorException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_project_index_with_view_admin_project_index(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $projects = Project::factory(15)->withTestImage()->create();

        $response = $this->actingAs($user)->get(route('admin.project.index', ['page' => 1]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.project.index');
        $response->assertViewHas('projects', function (LengthAwarePaginator $data) use ($projects) {
            return $data->total() === $projects->count();
        });
        $response->assertSee('Projects');
        $response->assertSeeInOrder($projects->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)->pluck('id')->toArray());
        $response->assertSeeInOrder($projects->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)->pluck('title')->toArray());
        $response->assertSeeInOrder($projects->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)->pluck('description')->toArray());

        foreach ($projects->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value) as $project) {
            $response->assertSee($project->category->title);
        }
    }
}

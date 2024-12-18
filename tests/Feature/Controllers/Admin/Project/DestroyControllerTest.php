<?php

namespace Tests\Feature\Controllers\Admin\Project;

use App\Enums\UserRoles;
use App\Models\Project;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DestroyControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_project_destroy(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $project = Project::factory()->withTestImage()->create();

        $response = $this->actingAs($user)->delete(route('admin.project.destroy', $project));

        $response->assertFound();
        $response->assertRedirect(route('admin.project.index'));
    }
}

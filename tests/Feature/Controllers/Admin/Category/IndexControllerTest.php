<?php

namespace Tests\Feature\Controllers\Admin\Category;

use App\Enums\PageSettings;
use App\Enums\UserRoles;
use App\Models\Category;
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
    public function test_response_for_route_admin_category_index_with_view_admin_category_index(): void
    {
        $this->withoutDeprecationHandling();

        $user = User::factory()->create(['role' => UserRoles::ADMIN]);
        $categories = Category::factory(15)->create();

        $response = $this->actingAs($user)->get(route('admin.category.index', ['page' => 1]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.index');
        $response->assertViewHas('categories', function (LengthAwarePaginator $data) use ($categories) {
            return $data->total() === $categories->count();
        });
        $response->assertSee('Categories');

        $response->assertSeeInOrder(
            $categories->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)->pluck('title')->toArray()
        );
    }
}

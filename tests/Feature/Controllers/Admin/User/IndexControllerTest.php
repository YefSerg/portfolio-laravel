<?php

namespace Tests\Feature\Controllers\Admin\User;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\PageSettings;
use App\Enums\UserRoles;
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
    public function test_response_for_route_admin_user_index_with_view_admin_user_index(): void
    {
        $this->withoutDeprecationHandling();

        $users = User::factory(15)->create();
        $authUser = $users->first();
        $authUser->role = UserRoles::SUPER_ADMIN;
        $authUser->save();

        $response = $this->actingAs($authUser)->get(route('admin.user.index', ['page' => 1]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.user.index');
        $response->assertViewHas('users', function (LengthAwarePaginator $data) use ($users) {
            return $data->total() === $users->count();
        });
        $response->assertSee('Users');
        $response->assertSeeInOrder(
            $users->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)->pluck('id')->toArray()
        );
        $response->assertSeeInOrder(
            $users->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)->pluck('name')->toArray()
        );
        $response->assertSeeInOrder(
            $users->take(PageSettings::ADMIN_QUANTITY_ITEMS_PER_PAGE->value)->pluck('email')->toArray()
        );
    }
}

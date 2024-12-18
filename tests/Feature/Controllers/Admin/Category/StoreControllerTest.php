<?php

namespace Tests\Feature\Controllers\Admin\Category;

use App\Enums\UserRoles;
use App\Models\Category;
use App\Models\User;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
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
    public function test_response_for_route_admin_category_store(): void
    {
        $this->withoutDeprecationHandling();

        $data = Category::factory()->make()->toArray();

        $response = $this->actingAs($this->user)->post(route('admin.category.store'), $data);

        $response->assertFound();
        $response->assertRedirect(route('admin.category.index'));

        $this->assertDatabaseHas('categories', $data);
        $this->assertDatabaseCount('categories', 1);
    }

    public function test_validation_for_store_category_fails(): void
    {
        $data = [
            [
                'title' => null,
            ],
            [
                'title' => Str::random(256),
            ],
        ];

        foreach ($data as $item) {
            $response = $this->actingAs($this->user)->post(route('admin.category.store'), $item);

            $response->assertSessionHasErrors(array_keys($item));
            $response->assertRedirect();
            $response->assertInvalid(array_keys($item));

            $this->assertDatabaseMissing('categories', $item);
        }
    }

    public function test_validation_for_store_category_unique_title_fails(): void
    {
        $data = ['title' => 'Title 1'];

        Category::factory()->create($data);

        $response = $this->actingAs($this->user)->post(route('admin.category.store'), $data);
        $response->assertSessionHasErrors(['title']);
        $response->assertRedirect();
        $response->assertInvalid(['title']);

        $this->assertDatabaseCount('categories', 1);
    }
}

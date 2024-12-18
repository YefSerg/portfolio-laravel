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

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    private Category $category;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = Category::factory()->create();
        $this->user = User::factory()->create(['role' => UserRoles::ADMIN]);
    }

    /**
     * @throws ErrorException
     */
    #[Test]
    public function test_response_for_route_admin_category_update(): void
    {
        $this->withoutDeprecationHandling();

        $data = Category::factory()->make()->toArray();

        $response = $this->actingAs($this->user)->patch(route('admin.category.update', ['category' => $this->category]), $data);

        $response->assertFound();
        $response->assertRedirect(route('admin.category.show', ['category' => $this->category]));

        $this->assertDatabaseHas('categories', $data);
        $this->assertDatabaseCount('categories', 1);
    }

    public function test_validation_for_update_category_fails(): void
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
            $response = $this->actingAs($this->user)->patch(route('admin.category.update', ['category' => $this->category]), $item);

            $response->assertSessionHasErrors(array_keys($item));
            $response->assertRedirect();
            $response->assertInvalid(array_keys($item));

            $this->assertDatabaseMissing('categories', $item);
        }
    }

    public function test_validation_for_update_category_unique_title_fails(): void
    {
        $title = $this->category->title;

        $response = $this->actingAs($this->user)->patch(route('admin.category.update', ['category' => $this->category]), compact('title'));
        $response->assertSessionHasErrors('title');
        $response->assertRedirect();
        $response->assertInvalid('title');
    }
}

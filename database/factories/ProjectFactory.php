<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word(),
            'description' => $this->faker->text(),
            'category_id' => Category::factory(),
        ];
    }

    public function withTestImage(): self
    {
        return $this->state(['image' => 'test.png']);
    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function withLoremImage(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'image' => $this->faker->loremImage('projects'),
        ]);
    }
}

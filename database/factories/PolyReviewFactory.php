<?php

namespace Database\Factories;

use App\Models\PolyReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PolyReview>
 */
class PolyReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->realText(),
            'user_id' => User::query()->get()->random()->id,
        ];
    }
}

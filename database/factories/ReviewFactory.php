<?php

namespace Database\Factories;

use App\Models\Advice;
use App\Models\LifeEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'score' => fake()->randomFloat(1,0,10),
            'advice_id' => Advice::factory()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'source' => $this->faker->word()
        ];
    }

    public function withOwner(): self
    {
        return $this->state([
            'owner_id' => User::factory()->create()->id
        ]);
    }

    public function withCreator(): self
    {
        return $this->state([
            'user_id' => User::factory()->create()->id
        ]);
    }
}

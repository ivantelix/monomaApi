<?php

namespace Tests\RequestFactories\Lead;

use App\Models\User;
use Worksome\RequestFactories\RequestFactory;


class LeadRequestFactory extends RequestFactory
{
    public function definition(): array
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

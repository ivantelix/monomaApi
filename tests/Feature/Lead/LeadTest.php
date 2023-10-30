<?php

namespace Tests\Feature\Lead;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\CreatesApplication;
use Tests\RequestFactories\Lead\LeadRequestFactory;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use CreatesApplication, DatabaseTransactions;

    public function test_user_manager_can_create_lead()
    {
        $lead = LeadRequestFactory::new()
            ->withOwner()
            ->withCreator()
            ->create();

        $manager = User::where('email', 'manager@email.com')->first();

        $response = $this->actingAs($manager)
            ->postJson('/api/v1/lead', $lead);

        $response->assertCreated();
    }

    public function test_user_agent_cant_create_lead()
    {
        $lead = LeadRequestFactory::new()
            ->withOwner()
            ->withCreator()
            ->create();

        $agent = User::where('email', 'agent@email.com')->first();

        $response = $this->actingAs($agent)
            ->postJson('/api/v1/lead', $lead);

        $response->assertForbidden();
    }

    public function test_user_agent_list_just_leads_owner()
    {
        $manager = User::where('email', 'manager@email.com')->first();
        $agent = User::where('email', 'agent@email.com')->first();

        Lead::factory()->state([
            'owner_id' => $manager->id,
        ])->withCreator()->create();


        $leads_agent = Lead::factory()->count(2)->state([
            'owner_id' => $agent->id,
        ])->withCreator()->create();

        $response = $this->actingAs($agent)
            ->getJson('/api/v1/leads');

        $response->assertJsonCount(2, 'data');
    }

    public function test_user_manager_list_all_leads()
    {
        $manager = User::where('email', 'manager@email.com')->first();
        $agent = User::where('email', 'agent@email.com')->first();

        Lead::factory()->state([
            'owner_id' => $manager->id,
        ])->withCreator()->create();


        Lead::factory()->count(2)->state([
            'owner_id' => $agent->id,
        ])->withCreator()->create();

        $response = $this->actingAs($manager)
            ->getJson('/api/v1/leads');

        $response->assertJsonCount(3, 'data');
    }

    public function test_get_lead_by_id()
    {
        $lead = Lead::factory()->state([
            'owner_id' => User::factory()->create()->id,
        ])->withCreator()->create();

        $response = $this->actingAs($lead->owner)
            ->getJson("/api/v1/lead/{$lead->id}");

        $response->assertOk();
    }

    public function test_unauthorized_user_not_authenticated()
    {
        $response = $this->getJson('/api/v1/leads');
        $response->assertUnauthorized();
    }
}

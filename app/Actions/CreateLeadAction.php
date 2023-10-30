<?php

namespace App\Actions;

use App\Http\Resources\Lead\LeadResource;
use App\Models\Lead;

final class CreateLeadAction
{
    public function handle($data): LeadResource | null
    {
        $lead = Lead::create([
            'name' => $data['name'],
            'source' => $data['source'],
            'owner_id' => $data['owner_id'],
            'user_id' => auth()->user()->id
        ]);

        return LeadResource::make($lead) ?? null;
    }
}

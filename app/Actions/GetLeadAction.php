<?php

namespace App\Actions;

use App\Http\Resources\Lead\LeadResource;
use App\Models\Lead;

final class GetLeadAction
{
    public function handle($lead): LeadResource | null
    {
        $lead = Lead::find($lead);
        return LeadResource::make($lead) ?? null;
    }
}

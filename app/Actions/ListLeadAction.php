<?php

namespace App\Actions;

use App\Http\Resources\Lead\LeadResourceCollection;
use App\Models\Lead;
use Illuminate\Support\Facades\Gate;

final class ListLeadAction
{
    public function handle()
    {
        match (Gate::allows('manager')) {
            true => $leads = Lead::all(),
            false => $leads = Lead::where('owner_id', auth()->user()->id)->get(),
            default => $leads = []
        };

        return new LeadResourceCollection($leads) ?? [];
    }
}

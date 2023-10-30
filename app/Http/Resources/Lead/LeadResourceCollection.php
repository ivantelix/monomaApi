<?php

namespace App\Http\Resources\Lead;

use Illuminate\Http\Resources\Json\JsonResource;

class LeadResourceCollection extends JsonResource
{

    public function toArray($request): array
    {
        return [
            "meta" => [
                "success" => true,
                "errors" => [],
            ],
            "data" => $this->resource->map(function ($lead) {
                return [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'source' => $lead->source,
                    'owner' => $this->getOwner($lead),
                    'created_at' => $lead->created_at,
                    'updated_at' => $lead->updated_at,
                    'created_by' => $this->getCreator($lead),
                ];
            }),
        ];
    }

    private function getOwner($lead): array
    {
        return [
            'id' => $lead->owner->id,
            'name' => $lead->owner->username,
        ];
    }

    private function getCreator($lead): array
    {
        return [
            'id' => $lead->creator->id,
            'name' => $lead->creator->username,
        ];
    }
}

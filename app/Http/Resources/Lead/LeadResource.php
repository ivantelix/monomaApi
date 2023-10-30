<?php

namespace App\Http\Resources\Lead;

use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{

    public static $wrap = 'meta';

    public function toArray($request): array
    {
        return [
            "success" => true,
            "errors" => [],
            "data" => [
                'id' => $this->resource->id,
                'name' => $this->resource->name,
                'source' => $this->resource->source,
                'owner' => $this->getOwner(),
                'created_at' => date_format($this->resource->created_at, 'Y-m-d H:i:s'),
                'updated_at' => date_format($this->resource->updated_at, 'Y-m-d H:i:s'),
                'created_by' => $this->getCreator(),
            ]
        ];
    }

    private function getOwner(): array
    {
        return [
            'id' => $this->resource->owner->id,
            'name' => $this->resource->owner->username,
        ];
    }

    private function getCreator(): array
    {
        return [
            'id' => $this->resource->creator->id,
            'name' => $this->resource->creator->username,
        ];
    }
}

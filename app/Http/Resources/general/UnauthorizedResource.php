<?php

namespace App\Http\Resources\general;

use Illuminate\Http\Resources\Json\JsonResource;

class UnauthorizedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "meta" => [
                "success" => false,
                "errors" => [
                    "unauthorized" => "Token expired"
                ],
            ],
        ];
    }
}

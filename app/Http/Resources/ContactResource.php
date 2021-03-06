<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'town_city' => $this->town_city,
            'region_county' => $this->region_county,
            'country_code' => $this->country_code,
            'post_code' => $this->post_code,

            'notes' => ContactNoteResource::collection($this->whenLoaded('notes')),
            // 'company' => new CompanyResource($this->whenLoaded('company')),
            // 'company' => $this->company,
        ];
    }
}

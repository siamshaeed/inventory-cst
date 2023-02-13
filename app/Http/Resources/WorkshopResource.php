<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->getLogo(),
            'signature' => $this->getSignature(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'contact_no' => $this->contact_no,
            'opening_time' => $this->opening_time,
            'closing_time' => $this->closing_time,
            'service_feedback_count' => $this->service_feedback_count,
            'rating' => $this->service_feedback_count ? $this->getRating() : 'No Ratings',
            'distance' => $this->distance,
        ];
    }
}

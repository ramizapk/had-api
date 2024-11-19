<?php

namespace App\Http\Resources\V1\App;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'is_active' => $this->isActive(),
            'is_suspended' => $this->isSuspended(),
            'locations' => $this->whenLoaded('addresses', function () {
                return $this->addresses->reduce(function ($carry, $address) {
                    $carry[$address->is_default ? 'active' : 'other_locations'][] = [
                        'id' => $address->id,
                        'name' => $address->name,
                        'location' => $address->latitude . ',' . $address->longitude
                    ];
                    return $carry;
                }, ['active' => [], 'other_locations' => []]);
            }),
        ];
    }
}

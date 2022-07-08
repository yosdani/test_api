<?php

namespace App\Http\Resources;

use App\Models\Client;
use App\Models\VehicleType;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'enrollment' => $this->enrollment,
            'color'=> $this->color,
            'client'=>Client::find($this->client_id)->name,
            'vehicle_type'=>VehicleType::find($this->vehicle_type_id)->name,
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterClientResource extends JsonResource
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
            'enrollment' => Vehicle::find($this->vehicle_id)->enrollment,
            'date'=> $this->date,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
            'total_time'=>$this->total_time,
             'amount'=>$this->amount,
        ];
    }
}

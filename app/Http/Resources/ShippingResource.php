<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'=>$this->id,
            'lat'=>$this->lat,
            'long'=>$this->long,
            'address'=>$this->address,
            'city'=>$this->city,
            'country'=>$this->country,
            'phone_number'=>$this->phone_number,
            'notes'=>$this->notes,
        ];
    }
}

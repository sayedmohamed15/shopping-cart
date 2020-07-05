<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'item_id'=>$this->item_id,
            'user_id'=>$this->user_id,
            'quantity'=>$this->quantity,
            'created_at'=>$this->created_at,
        ];
    }
}

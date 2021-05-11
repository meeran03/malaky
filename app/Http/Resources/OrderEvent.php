<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderEvent extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = $request->header('Accept-Language');
        return [
            'id'                => (int) $this->id,
            'min_price'         => (double) $this->min_price,
            'max_price'         => (double) $this->max_price,
            'from'              => ($this->destination && $this->destinationFrom) ? (string) $this->destinationFrom->title : '',
            'to'                => ($this->destination && $this->destinationTo) ? (string) $this->destinationTo->title : '',
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDeserve extends JsonResource
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
            'deserve'           => ( $this->deserve < 0 ) ? 0 : (double) $this->deserve ,
            'payment_type'      => (string) $this->payment_type ,
            'status_id'         => (int) $this->status_id,
            'status'            => ($this->status) ? (string) $this->status->translate($lang)->title : '',
        ];
    }
}

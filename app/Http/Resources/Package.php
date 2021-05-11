<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Package extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => (int) $this->id,
            'title'     => (string) $this->translate($request->header('Accept-Language'))->title,
            'units'     => (int) $this->units,
            'price'     => (double) $this->price,
            'feature_1' => (string) $this->translate($request->header('Accept-Language'))->feature_1,
            'feature_2' => (string) $this->translate($request->header('Accept-Language'))->feature_2,
            'feature_3' => (string) $this->translate($request->header('Accept-Language'))->feature_3,
            'feature_4' => (string) $this->translate($request->header('Accept-Language'))->feature_4,
        ];
    }
}

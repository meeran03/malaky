<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Child extends JsonResource
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
            'id'           => (int) $this->id,
            'title'        => (string) $this->title,
            'years'        => (int) $this->years,
            'months'       => (int) $this->months,
            'medicine'     => (int) $this->medicine,
            'notes'        => (string) $this->notes,
        ];
    }
}

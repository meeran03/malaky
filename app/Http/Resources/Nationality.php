<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Nationality extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $title = 'title_' . $request->header('Accept-Language');
        return [
            'id' => (int) $this->id,
            'title' => (string) $this->$title
        ];
    }
}

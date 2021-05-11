<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sitter extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $title = 'title_' . $request->header('Accept-Language');
        return [
            'id'             => (int) $this->id,
            'name'           => (string) $this->name,
            'image'          => (string) $this->imagePath,
            'rate'           => (double) $this->rate ?? 0,
        ];
    }
}

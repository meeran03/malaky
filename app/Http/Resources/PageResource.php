<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'id'             => (int) $this->id,
            'title'          => (string) $this->translate($lang)->title,
            'excerpt'        => (string) strip_tags($this->translate($lang)->excerpt),
            'content'        => (string) strip_tags($this->translate($lang)->content),
        ];
    }
}

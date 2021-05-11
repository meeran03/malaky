<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        Carbon::setLocale($request->header('Accept-Language'));
        return [
            'id'             => (int) $this->id,
            'name'           => (string) $this->user->name,
            'image'          => (string) $this->user->imagePath,
            'type'           => (string) $this->type,
            'message'        => (string) $this->content,
            'date'           => (string) Carbon::parse($this->created_at)->diffForHumans(),
            'time'           => (string) Carbon::parse($this->created_at)->format('g:i A'),
        ];
    }
}

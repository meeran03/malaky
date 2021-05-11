<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Chat extends JsonResource
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
        Carbon::setLocale($request->header('Accept-Language'));
        return [
            'id'             => (int) $this->user->id,
            'name'           => (string) $this->user->name,
            'image'          => (string) $this->user->imagePath,
            'message'        => (string) $this->messages->last()->content,
            'date'           => (string) Carbon::parse($this->messages->last()->created_at)->diffForHumans(),
            'time'           => (string) Carbon::parse($this->messages->last()->created_at)->format('g:i A'),
        ];
    }
}

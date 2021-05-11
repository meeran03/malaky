<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $title = $request->header('Accept-Language');
        Carbon::setLocale($title);
        return [
            'id'    => (int) $this['data']['notify_id'],
            'title' => (string) $this['data'][$title],
            'read'  => (int) (boolean) $this['read_at'],
            'date'  => (string) Carbon::parse($this['created_at'])->diffForHumans(),
            'type'  => $this['data']['url'] ? (string) explode("/", $this['data']['url'] , 2)[0] : '',
            'ref_id' => $this['data']['url'] ? (int) explode("/", $this['data']['url'] , 2)[1] : 0
        ];
    }
}

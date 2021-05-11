<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
            'id'              => (int) $this->id,
            'user'            => ( $this->user ) ? [  'id'             => (int) $this->user_id ,
                                    'name'           => (string) $this->user->name,
                                    'phone'          => (string) $this->user->phone,
                                    'image'          => (string) $this->user->imagePath,
                                    'rate'           => (double) $this->user->rate ,
                                ] : null,
            'receiver'        => ( $this->receiver ) ? [  'id'             => (int) $this->receiver_id ,
                                    'name'           => (string) $this->receiver->name,
                                    'phone'          => (string) $this->receiver->phone,
                                    'image'          => (string) $this->receiver->imagePath,
                                    'rate'           => (double) $this->receiver->rate ,
                                ] : null,
            'units'           => (int) $this->units,
//            'date'            => (string) $this->date->format('Y-m-d') ,
            'from'            => (string) $this->from,
            'to'              => (string) $this->to,
            'details'         => (string) $this->details ,
            'reason'          => (string) $this->reason ,
            'status_id'       => (int) $this->status_id,
            'status'          => ($this->status) ? (string) $this->status->translate($lang)->title : '',
            'children'        => ($this->children) ? (int) $this->children->count() : 0,
        ];
    }
}

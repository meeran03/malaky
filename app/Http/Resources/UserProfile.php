<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfile extends JsonResource
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
            'email'          => (string) $this->email,
            'phone'          => (string) $this->phone,
            'emergency'      => (string) $this->emergency,
            'nationality_id' => (int) $this->nationality_id,
            'nationality'    => ( $this->nationality_id ) ? (string) $this->nationality->$title : '',
            'image'          => (string) $this->imagePath,
            'rate'           => (double) $this->rate ?? 0,
            'type_id'        => (int) $this->type_id,
            'type'           => ( $this->type_id ) ? (string) $this->type->title : '',
            'bio'            => (string) $this->bio,
            'address'        => ( $this->currentAddress ) ? [ 'lat' => $this->currentAddress->lat , 'long' => $this->currentAddress->long , 'title' => $this->currentAddress->title ] : null,
            'is_active'      => (int) $this->is_active,
            'distance'       => (double) $this->distance ?? 0,
            'units'          => (int) $this->units ,
            'verification_code' =>  (string) $this->verification_code ?? "",
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Schedule extends Resource
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
            'id' => $this->id,
            'date' => $this->date,
            'email' => $this->email,
            'name' => $this->name,
            'status' => $this->status,
            'details' => $this->detail
        ];
    }
}

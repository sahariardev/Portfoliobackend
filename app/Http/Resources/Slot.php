<?php

namespace App\Http\Resources;
use App\Http\Resources\Schedule;
use Illuminate\Http\Resources\Json\Resource;

class Slot extends Resource
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
            'slot' => $this->points,
            'schedule' => new Schedule($this->Schedule)
        ];
    }
}

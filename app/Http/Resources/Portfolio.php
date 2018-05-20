<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

use App\Http\Resources\Gallery as GalleryResource ;
use App\Gallery;
use App\Http\Resources\Technology as TechnologyResource ;
class Portfolio extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     
     
     //return GalleryResource::collection($g);
     
        return [

            'id' => $this->id,
            'title' => $this->title,
            'order' => $this->order,
            'video_link' => $this->video_link,
            'details' => $this->details,
            'type' => $this->type,
            'coverImage_link' => $this->coverImage_link,
            'detailImage_link' => $this->detailImage_link,
            'gallery' => new GalleryResource($this->gallery),
            'technologies' => TechnologyResource::collection($this->technologies)

        ];
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;
use App\Technology;

class Portfolio extends Model
{
    protected $fillable=[

        'title',
        'order',
        'video_link',
        'details',
        'type',
        'coverImage_link',
        'detailImage_link',
        'gallery_id'
    ];

    //define relationship

   public function gallery()
   {
       return $this->belongsTo(Gallery::class);
   }
   public function technologies()
   {
       return $this->belongsToMany(Technology::class,'portfolio_technologies');
      
   }

}

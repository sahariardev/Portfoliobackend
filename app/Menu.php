<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=[

        'order','parent_id','title','link'
    ];

    public function childrens()
    {
        return $this->hasMany('App\Menu','parent_id');

    }
    public function parent()
    {
        return $this->belongsTo('App\Menu','parent_id');
    }
}

<?php

namespace App;
use App\Portfolio;
use Illuminate\Database\Eloquent\Model;


class Gallery extends Model
{
    

    protected $fillable=[
        
        'images',
        'details'
    ];

    public function portfolio()
    {
       return $this->hasMany(Portfolio::class);   
    } 
    public function getRouteKeyName()
    {
        return "id";
    }
}

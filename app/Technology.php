<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;

class Technology extends Model
{
    protected $fillable =[
       'title',
       'detail' 

    ];

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class,'portfolio_technologies');
    }
}

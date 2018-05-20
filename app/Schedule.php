<?php

namespace App;

use App\Slot;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable=[
         'date',
         'email',
         'name',
         'detail',
         'status'


    ];

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}

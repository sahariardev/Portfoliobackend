<?php

namespace App;
use App\Schedule;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable=[
        'points',
        'schedule_id'
    ];

    public function Schedule()
    {
        return $this->belongsTo(Schedule::class);    
    }
}

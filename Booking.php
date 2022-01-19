<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

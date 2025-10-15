<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrderLog extends Model
{
    protected $fillable = ['service_booking_id', 'action', 'description', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

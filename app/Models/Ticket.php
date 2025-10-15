<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject',
        'description',
        'type',
        'service_booking_id',
        'agent_id',
        'assigned_to',
        'status',
    ];
    public function messages() {
    return $this->hasMany(TicketMessage::class)->latest();
}

public function agent() {
    return $this->belongsTo(User::class,'agent_id');
}

public function assignedStaff() {
    return $this->belongsTo(User::class,'assigned_to');
}

public function serviceBooking() {
    return $this->belongsTo(ServiceBooking::class);
}

}

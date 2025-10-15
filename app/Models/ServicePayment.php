<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_booking_id', 'amount', 'payment_mode',
        'remarks', 'payment_date', 'status', 'admin_note', 'invoice_number'
    ];

    protected static function booted()
    {
        static::creating(function ($payment) {
            $nextId = (ServicePayment::max('id') ?? 0) + 1;
            $payment->invoice_number = 'INV-' . now()->format('Y') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }



    public function serviceBooking()
    {
        return $this->belongsTo(ServiceBooking::class, 'service_booking_id');
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

 
}

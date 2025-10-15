<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_order_number',
        'service_id',
        'agent_id',
        'staff_id',
        'client_first_name',
        'client_last_name',
        'client_phone',
        'status',
        'status_remarks',
        'amount',
        'remarks',
        'total_amount',
        'amount_paid',
        'payment_status',
        'invoice_number',
        'invoice_generated_at'
    ];

    protected $casts = [
    'invoice_generated_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function documents()
    {
        return $this->hasMany(ServiceBookingDocument::class, 'booking_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function logs()
    {
        return $this->hasMany(ServiceOrderLog::class)->latest();
    }

    /** Get all payments  */
    public function payments()
    {
        return $this->hasMany(ServicePayment::class);
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    public function getBalanceDueAttribute()
    {
        return $this->total_amount - $this->total_paid;
    }

    public function totalAmount()
    {
        return $this->total_amount;
    }
    /**
     * Get pending payment of all the bookings
     */
    public static function totalPendingPayments()
    {
        return self::whereIn('status', ['In Progress','Completed'])
            ->selectRaw('SUM(total_amount - amount_paid) as pending')
            ->value('pending');
    }

    /** Get pending payment of all the bookings for a specific staff  */
    public function scopeTotalPendingPayments($query)
    {
        return $query->whereIn('status', ['In Progress','Completed'])
            ->selectRaw('SUM(total_amount - amount_paid) as pending')
            ->value('pending');
    }




  

    
}

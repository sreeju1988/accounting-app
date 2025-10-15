<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceBookingDocument extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id','document_rule_id','file_path'];

    public function booking() {
        return $this->belongsTo(ServiceBooking::class, 'booking_id');
    }

    public function documentRule() {
        return $this->belongsTo(DocumentRule::class);
    }
}

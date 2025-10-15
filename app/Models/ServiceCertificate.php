<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_booking_id',
        'file_title',
        'uploaded_by',
        'file_name',
        'file_path',
        'file_type',
        'notes',
    ];

    public function serviceOrder()
    {
        return $this->belongsTo(ServiceBooking::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}

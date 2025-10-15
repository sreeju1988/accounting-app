<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceDocument extends Model
{
   use HasFactory;

    protected $fillable = ['service_id', 'document_rule_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function documentRule()
    {
        return $this->belongsTo(DocumentRule::class);
    }

    /** Download the service document file */
    public function downloadFile()
    {
        $filePath = storage_path('app/' . $this->file_path);
        return response()->download($filePath);
    }

    public function bookings() {
        return $this->hasMany(ServiceBookingDocument::class, 'document_rule_id', 'document_rule_id');
    }
}

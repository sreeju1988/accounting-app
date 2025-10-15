<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ServiceDocument;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'short_description', 'description', 'deadline', 'status'];

    public function documents()
    {
        return $this->hasMany(ServiceDocument::class);
    }
}

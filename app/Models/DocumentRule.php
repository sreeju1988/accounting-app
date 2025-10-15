<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRule extends Model
{
    protected $fillable = ['name', 'formats', 'max_size'];
    // public function userDocuments()
    // {
    //     return $this->hasMany(UserDocument::class);
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentInvitation extends Model
{
  protected $fillable = [
        'email',
        'role',
        'token',
        'expires_at',
        'accepted',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'accepted' => 'boolean',
    ];
}

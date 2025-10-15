<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;

class User extends Authenticatable
{
    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_STAFF       = 'staff';
    const ROLE_AGENT       = 'agent';
    const ROLE_CLIENT      = 'client';

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isStaff()
    {
        return $this->role === self::ROLE_STAFF;
    }

    public function isAgent()
    {
        return $this->role === self::ROLE_AGENT;
    }

    public function isClient()
    {
        return $this->role === self::ROLE_CLIENT;
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function roleType()
    {
        if($this->role=="super_admin") return "Admin";
        if($this->role=="staff") return "Staff";
        if($this->role=="agent") return "Agent";
        if($this->role=="client") return "Client";
        return "Unknown";
    }

    // Get the count of bookings active assigned to the staff which will exclude completed and cancelled bookings
    public function activeBookingsCount()
    {
        return $this->hasMany(ServiceBooking::class, 'staff_id')
                    ->whereNotIn('status', ['completed', 'cancelled'])
                    ->count();
    }

    public function inprogress_bookings()
    {
        //retrieve bookings for the staff with status not completed or cancelled
        return $this->hasMany(ServiceBooking::class, 'staff_id')->whereNotIn('status', ['Completed', 'Cancelled'])->latest();
    }

    public function serviceBookings()
    {
        return $this->hasMany(ServiceBooking::class, 'agent_id');
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


}

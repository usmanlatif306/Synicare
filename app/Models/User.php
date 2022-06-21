<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password', 'phone', 'address', 'date_of_birth', 'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    // user allergies
    public function allergies()
    {
        return $this->hasMany(Allergy::class)->latest();
    }

    // // user medictions
    // public function medications()
    // {
    //     return $this->hasMany(Medication::class)->latest();
    // }

    // user appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class)->latest();
    }

    // user active subscription
    public function subscription()
    {
        return $this->hasOne(Subscription::class)->where('expired_at', '>=', now())->latest();
    }

    // user all subscriptions
    public function subscriptions($search = "")
    {
        return $this->hasMany(Subscription::class)->latest();
    }
}

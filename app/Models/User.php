<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = ['name', 'email'];

    public function notificationTypes()
    {
        return $this->belongsToMany(NotificationType::class, 'user_notifications');
    }
    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Patient extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'age',
        'profile_image',
        'date_of_birth',
        'gender',
        'blood_group',
        'medical_history',
        'attachments',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'medical_history' => 'array',
        'attachments' => 'array',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->profile_image) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&size=150';
        }
        if (Str::startsWith($this->profile_image, ['https://', 'http://'])) {
            return $this->profile_image;
        }
        return asset('storage/' . $this->profile_image);
    }
    // Relationships
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

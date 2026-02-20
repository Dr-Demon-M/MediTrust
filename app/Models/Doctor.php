<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'photo',
        'specialty_id',
        'years_experience',
        'consultation_fee',
        'rating',
        'status',
        'bio',
    ];

    //Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->photo) {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&size=150';
        }
        if (Str::startsWith($this->photo, ['https://', 'http://'])) {
            return $this->photo;
        }
        return asset('storage/' . $this->photo);
    }

    // Relationships
    public function specialty()
    {
        return $this->belongsTo(specialty::class);
    }

    public function availability()
    {
        return $this->hasMany(Availability::class);
    }

    // Scopes
    public function ScopeFilter(Builder $builder, array $filters)
    {
        $builder->when($filters['specialty'] ?? false, function ($builder, $value) {
            $builder->where('specialty_id', $value);
        });
    }

    public function badge(){
        return match ($this->status) {
            'active' => 'success',
            'inactive' => 'primary',
            'on_leave' => 'danger',
            default => 'secondary',
        };
    }
}

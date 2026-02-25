<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $guarded = [];

    public function ScopeFilter(Builder $builder, array $filters)
    {
        $builder->when($filters['specialty'] ?? null, function ($builder, $value) {
            $builder->where('specialty_id', $value);
        });
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

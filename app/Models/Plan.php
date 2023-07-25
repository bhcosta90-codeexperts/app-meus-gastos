<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'slug',
        'reference',
    ];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value * 100,
            set: fn ($value) => $value / 100,
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'rule',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function rule(): Attribute
    {
        return Attribute::make(
            get: fn ($rule) => json_decode($rule, true),
            set: fn ($rule) => json_encode($rule),
        );
    }
}

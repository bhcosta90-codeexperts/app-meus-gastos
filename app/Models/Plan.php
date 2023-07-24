<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'price',
        'slug',
        'reference',
    ];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}

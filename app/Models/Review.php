<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Review extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'reviews';

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'image',
        'rating',
        'review',
        'review_ar',
        'review_date',
        'status',
    ];

    protected $casts = [
        'review_date' => 'date',
        'rating' => 'integer',
        'status' => 'integer',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getDisplayNameAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->name_ar)) {
            return $this->name_ar;
        }

        return $this->name;
    }

    public function getDisplayReviewAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->review_ar)) {
            return $this->review_ar;
        }

        return $this->review;
    }
}

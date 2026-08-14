<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ServiceGalleryImage;

class Service extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'services';

    protected $casts = [
        'additional_videos_links' => 'array',
        'gallery_images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }

    public function subCategory()
    {
        return $this->belongsTo(
            SubCategory::class,
            'sub_category_id'
        );
    }

    public function service_images()
    {
        return $this->hasMany(
            ServiceGalleryImage::class
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}

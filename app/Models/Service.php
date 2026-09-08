<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Service extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'services';

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'short_desc',
        'short_desc_ar',
        'description',
        'description_ar',
        'meta_title',
        'meta_title_ar',
        'meta_description',
        'meta_description_ar',
        'meta_keywords',
        'meta_keywords_ar',
        'status',
        'image',
        'image_alt_text',
        'additional_videos_links',
        'gallery_images',
        'videos_link',
        'category_id',
        'sub_category_id',
    ];

    protected $casts = [
        'additional_videos_links' => 'array',
        'gallery_images' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function service_images()
    {
        return $this->hasMany(
            ServiceGalleryImage::class,
            'service_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Slug
    |--------------------------------------------------------------------------
    */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    */

    public function getLocalizedNameAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->name_ar)) {
            return $this->name_ar;
        }

        return $this->name;
    }

    public function getLocalizedShortDescAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->short_desc_ar)) {
            return $this->short_desc_ar;
        }

        return $this->short_desc;
    }

    public function getLocalizedDescriptionAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->description_ar)) {
            return $this->description_ar;
        }

        return $this->description;
    }

    public function getLocalizedMetaTitleAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->meta_title_ar)) {
            return $this->meta_title_ar;
        }

        return $this->meta_title;
    }

    public function getLocalizedMetaDescriptionAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->meta_description_ar)) {
            return $this->meta_description_ar;
        }

        return $this->meta_description;
    }

    public function getLocalizedMetaKeywordsAttribute()
    {
        if (app()->getLocale() === 'ar' && !empty($this->meta_keywords_ar)) {
            return $this->meta_keywords_ar;
        }

        return $this->meta_keywords;
    }
}

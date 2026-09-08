<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'description_ar',
        'slug',
        'meta_title',
        'meta_title_ar',
        'meta_description',
        'meta_description_ar',
        'meta_keywords',
        'meta_keywords_ar',
        'image',
        'image_alt_text',
        'status',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SubCategory extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'sub_categories';

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
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'sub_category_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    */

    public function getLocalizedNameAttribute(): string
    {
        if (app()->isLocale('ar') && filled($this->name_ar)) {
            return $this->name_ar;
        }

        return $this->name ?? '';
    }

    public function getLocalizedDescriptionAttribute(): string
    {
        if (app()->isLocale('ar') && filled($this->description_ar)) {
            return $this->description_ar;
        }

        return $this->description ?? '';
    }
}

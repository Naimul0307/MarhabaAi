<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    public function index($locale, $slug)
    {
        $subCategory = SubCategory::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'category',

                'services' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('id', 'desc');
                }
            ])
            ->firstOrFail();

        $isArabic = $locale === 'ar';

        return view('subcategory', [

            'subCategory' => $subCategory,

            'services' => $subCategory->services,

            /*
            |--------------------------------------------------------------------------
            | Page Controls
            |--------------------------------------------------------------------------
            */

            'showHero' => false,

            'showHomeSliders' => false,

            'isCategoriesPage' => false,

            'isCategoryPage' => false,

            'isSubCategoryPage' => true,

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta_title' => $isArabic
                ? (
                    $subCategory->meta_title_ar
                    ?: $subCategory->meta_title
                    ?: $subCategory->name_ar
                    ?: $subCategory->name
                )
                : (
                    $subCategory->meta_title
                    ?: $subCategory->name
                ),

            'meta_description' => $isArabic
                ? (
                    $subCategory->meta_description_ar
                    ?: $subCategory->meta_description
                    ?: Str::limit(
                        strip_tags(
                            $subCategory->description_ar
                            ?: $subCategory->description
                        ),
                        150
                    )
                )
                : (
                    $subCategory->meta_description
                    ?: Str::limit(
                        strip_tags($subCategory->description),
                        150
                    )
                ),

            'meta_keywords' => $isArabic
                ? (
                    $subCategory->meta_keywords_ar
                    ?: $subCategory->meta_keywords
                    ?: 'MIRROR BOOTH, PHOTO BOOTH, VIDEO BOOTH, EVENT SERVICES, DUBAI, UAE'
                )
                : (
                    $subCategory->meta_keywords
                    ?: 'MIRROR BOOTH, PHOTO BOOTH, VIDEO BOOTH, EVENT SERVICES, DUBAI, UAE'
                ),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    public function index($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)
            ->with([
                'category',

                'services' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('id', 'desc');
                }
            ])
            ->firstOrFail();


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
            'meta_title' =>
                $subCategory->meta_title
                ?? $subCategory->name,

            'meta_description' =>
                $subCategory->meta_description
                ?? Str::limit(
                    strip_tags($subCategory->description),
                    150
                ),

            'meta_keywords' =>
                $subCategory->meta_keywords
                ?? 'MIRROR BOOTH, PHOTO BOOTH, VIDEOS BOOTH, EVENT SERVICES, DUBAI, UAE',
        ]);
    }
}

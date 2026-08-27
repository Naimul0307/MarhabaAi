<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display all categories.
     */
    public function index()
    {
        $categories = Category::where('status', 1)
            ->with([
                'subCategories.services'
            ])
            ->orderBy('id', 'desc')
            ->get();

        return view('categories', [

            'categories' => $categories,

            /*
            |--------------------------------------------------------------------------
            | Page Controls
            |--------------------------------------------------------------------------
            */
            'isCategoriesPage' => true,

            'isCategoryPage' => false,

            'isSubCategoryPage' => false,

            'showHero' => false,

            'showHomeSliders' => false,


            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */
            'meta_title' =>
                'Marhaba Ai | Event Services in Dubai',

            'meta_description' =>
                'Explore our event services, photo booths, mirror booths, video booths and other event entertainment services in Dubai, UAE.',

            'meta_keywords' =>
                'PHOTO BOOTH, MIRROR BOOTH, VIDEO BOOTH, EVENT SERVICES, DUBAI, UAE',
        ]);
    }


    /**
     * Display a single category.
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'subCategories.services'
            ])
            ->firstOrFail();


        return view('category', [

            'category' => $category,

            'subCategories' => $category->subCategories,


            /*
            |--------------------------------------------------------------------------
            | Page Controls
            |--------------------------------------------------------------------------
            */
            'isCategoriesPage' => false,

            'isCategoryPage' => true,

            'isSubCategoryPage' => false,

            'showHero' => false,

            'showHomeSliders' => false,


            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */
            'meta_title' =>
                $category->meta_title
                ?? $category->name,

            'meta_description' =>
                $category->meta_description
                ?? Str::limit(
                    strip_tags($category->description),
                    150
                ),

            'meta_keywords' =>
                $category->meta_keywords
                ?? 'MIRROR BOOTH, PHOTO BOOTH, VIDEOS BOOTH, MAGAZIN BOOTH, EVENT SERVICES, DUBAI, UAE',
        ]);
    }
}

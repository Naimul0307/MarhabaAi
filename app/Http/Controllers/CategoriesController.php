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
                'subCategories' => function ($query) {

                    // Subcategories: oldest first
                    $query->orderBy('id', 'asc')
                        ->with([
                            'services' => function ($query) {

                                // Services: latest first
                                $query->orderBy('id', 'desc');

                            }
                        ]);

                }
            ])
            ->orderBy('id', 'desc')
            ->get();

        return view('categories', [

            'categories' => $categories,

            'isCategoriesPage' => true,

            'isCategoryPage' => false,

            'isSubCategoryPage' => false,

            'showHero' => false,

            'showHomeSliders' => false,

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
                'subCategories' => function ($query) {

                    // Latest subcategory first
                    $query->orderBy('id', 'desc')
                        ->with([
                            'services' => function ($query) {

                                // Latest service first
                                $query->orderBy('id', 'desc');

                            }
                        ]);

                }
            ])
            ->firstOrFail();


        return view('category', [

            'category' => $category,

            'subCategories' => $category->subCategories,

            'isCategoriesPage' => false,

            'isCategoryPage' => true,

            'isSubCategoryPage' => false,

            'showHero' => false,

            'showHomeSliders' => false,

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

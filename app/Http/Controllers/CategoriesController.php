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
                    $query->where('status', 1)
                        ->orderBy('id', 'asc')
                        ->with([
                            'services' => function ($query) {
                                $query->where('status', 1)
                                    ->orderBy('id', 'desc');
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
    public function category($locale, $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'subCategories' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('id', 'desc')
                        ->with([
                            'services' => function ($query) {
                                $query->where('status', 1)
                                    ->orderBy('id', 'desc');
                            }
                        ]);
                }
            ])
            ->firstOrFail();

        $isArabic = $locale === 'ar';

        return view('category', [
            'category' => $category,

            'subCategories' => $category->subCategories,

            'isCategoriesPage' => false,
            'isCategoryPage' => true,
            'isSubCategoryPage' => false,

            'showHero' => false,
            'showHomeSliders' => false,

            'meta_title' => $isArabic
                ? ($category->meta_title_ar ?: $category->meta_title ?: $category->name_ar ?: $category->name)
                : ($category->meta_title ?: $category->name),

            'meta_description' => $isArabic
                ? ($category->meta_description_ar
                    ?: $category->meta_description
                    ?: Str::limit(
                        strip_tags($category->description_ar ?: $category->description),
                        150
                    ))
                : ($category->meta_description
                    ?: Str::limit(
                        strip_tags($category->description),
                        150
                    )),

            'meta_keywords' => $isArabic
                ? ($category->meta_keywords_ar
                    ?: $category->meta_keywords
                    ?: 'MIRROR BOOTH, PHOTO BOOTH, VIDEO BOOTH, EVENT SERVICES, DUBAI, UAE')
                : ($category->meta_keywords
                    ?: 'MIRROR BOOTH, PHOTO BOOTH, VIDEO BOOTH, EVENT SERVICES, DUBAI, UAE'),
        ]);
    }
}

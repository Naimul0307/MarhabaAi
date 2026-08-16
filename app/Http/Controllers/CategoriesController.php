<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->with('subCategories')
            ->firstOrFail();

        return view('category', [
            'category' => $category,
            'subCategories' => $category->subCategories,
            'isCategoryPage' => true,
            'showHero' => false,
            'meta_title' => $category->meta_title ?? $category->name,

            'meta_description' => $category->meta_description
                ?? Str::limit(
                    strip_tags($category->description),
                    150
                ),

            'meta_keywords' => $category->meta_keywords
                ?? 'MIRROR BOOTH, PHOTO BOOTH, VIDEOS BOOTH, MAGAZIN BOOTH, EVENT SERVICES, DUBAI, UAE',
        ]);
    }
}

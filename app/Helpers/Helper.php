<?php

use App\Models\FeaturedService;
use App\Models\Setting;

function getSettings()
{
    return Setting::first();
}

function getCategories()
{
    return FeaturedService::leftJoin(
        'categories',
        'categories.id',
        '=',
        'featured_services.category_id'
    )
        ->whereNotNull('featured_services.category_id')
        ->where('categories.status', 1)
        ->orderBy('featured_services.sort_order', 'ASC')
        ->select(
            'featured_services.id',
            'featured_services.category_id',
            'featured_services.sort_order',
            'categories.name as category_name',
            'categories.name_ar as category_name_ar',
            'categories.slug as category_slug'
        )
        ->get();
}

function getSubCategories()
{
    return FeaturedService::leftJoin(
        'sub_categories',
        'sub_categories.id',
        '=',
        'featured_services.sub_category_id'
    )
        ->whereNotNull('featured_services.sub_category_id')
        ->where('sub_categories.status', 1)
        ->orderBy('featured_services.sort_order', 'ASC')
        ->select(
            'featured_services.id',
            'featured_services.sub_category_id',
            'featured_services.sort_order',
            'sub_categories.name as sub_category_name',
            'sub_categories.name_ar as sub_category_name_ar',
            'sub_categories.slug as sub_category_slug'
        )
        ->get();
}

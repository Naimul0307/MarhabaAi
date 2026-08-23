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
        'featured_services.*',
        'categories.name as category_name',
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
    ->orderBy('featured_services.sort_order', 'ASC')
    ->select(
        'featured_services.*',
        'sub_categories.name as sub_category_name',
        'sub_categories.slug as sub_category_slug'
    )
    ->get();
}

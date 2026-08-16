<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\FeaturedService;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);

        $categories = Category::orderBy('name', 'asc')->get();
        $sub_categories = SubCategory::orderBy('name', 'asc')->get();

        $featuredCategories = FeaturedService::whereNotNull('category_id')
            ->orderBy('sort_order', 'ASC')
            ->get();

        $featuredSubCategories = FeaturedService::whereNotNull('sub_category_id')
            ->orderBy('sort_order', 'ASC')
            ->get();

        return view('admin.settings', [
            'settings' => $settings,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'featuredCategories' => $featuredCategories,
            'featuredSubCategories' => $featuredSubCategories,
            'meta_title' => 'SETTINGS | Marhaba Ai',
            'meta_description' => 'CONFIGURE AND MANAGE THE SETTINGS FOR Marhaba Ai',
            'meta_keywords' => 'SETTINGS, ADMIN, Marhaba Ai, SERVICES, EVENTS, ADMIN PANEL',
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_title' => 'required',
        ]);

        if ($validator->passes()) {
            FeaturedService::query()->delete();

            $categories = json_decode($request->featured_categories, true);

            if (!empty($categories)) {
                foreach ($categories as $key => $categoryId) {
                    FeaturedService::create([
                        'category_id' => $categoryId,
                        'sub_category_id' => null,
                        'sort_order' => $key,
                    ]);
                }
            }

            $subCategories = json_decode($request->featured_sub_categories, true);

            if (!empty($subCategories)) {
                foreach ($subCategories as $key => $subCategoryId) {
                    FeaturedService::create([
                        'category_id' => null,
                        'sub_category_id' => $subCategoryId,
                        'sort_order' => $key,
                    ]);
                }
            }

            $settings = Setting::find(1);

            if ($settings == null) {
                $settings = new Setting();
            }

            $settings->website_title = $request->website_title;
            $settings->email = $request->email;
            $settings->phone = $request->phone;
            $settings->facebook_url = $request->facebook_url;
            $settings->twitter_url = $request->twitter_url;
            $settings->instagram_url = $request->instagram_url;
            $settings->whatsapp_url = $request->whatsapp_url;
            $settings->linkedin_url = $request->linkedin_url;
            $settings->tiktok_url = $request->tiktok_url;
            $settings->youtube_url = $request->youtube_url;
            $settings->contact_card_one = $request->contact_card_one;
            $settings->contact_card_two = $request->contact_card_two;
            $settings->copy = $request->copy;
            $settings->save();

            $request->session()->flash('success', 'Settings saved successfully');

            return response()->json([
                'status' => 200,
            ]);
        }

        return response()->json([
            'status' => 0,
            'errors' => $validator->errors(),
        ]);
    }
}

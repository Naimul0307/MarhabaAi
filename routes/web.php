<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\HeroSlideController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\ServicesController;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/category/{slug}', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/subcategory/{slug}', [SubCategoriesController::class, 'index'])->name('subcategory.index');
Route::get('/service/{slug}',[ ServicesController::class, 'detail'])->name('service.detail');

Route::prefix('admin')->group(function () {

    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/auth', [AdminLoginController::class, 'authenticate'])->name('admin.auth');
    });

    Route::middleware('admin.auth')->group(function () {

        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::post('/temp/upload', [TempImageController::class, 'upload'])->name('tempUpload');
        Route::post('/temp/uploads', [TempImageController::class, 'uploadGalleryImage'])->name('uploadGalleryImage');

        Route::get('/hero-slides', [HeroSlideController::class, 'index'])->name('heroSlideList');
        Route::get('/hero-slides/create', [HeroSlideController::class, 'create'])->name('heroSlide.create');
        Route::post('/hero-slides/create', [HeroSlideController::class, 'save'])->name('heroSlide.store');
        Route::get('/hero-slides/edit/{id}', [HeroSlideController::class, 'edit'])->name('heroSlide.edit');
        Route::post('/hero-slides/edit/{id}', [HeroSlideController::class, 'update'])->name('heroSlide.update');
        Route::post('/hero-slides/delete/{id}', [HeroSlideController::class, 'delete'])->name('heroSlide.delete');
        Route::get('/hero-slides/get-slug', [HeroSlideController::class, 'getSlug'])->name('heroSlide.slug');
        Route::post('/hero-slides/{id}/remove-image', [HeroSlideController::class, 'removeMainImage'])->name('heroSlide.remove.image');

        Route::get('/category', [CategoryController::class, 'index'])->name('categoryList');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/create', [CategoryController::class, 'store'])->name('category.save');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/category/get-slug', [CategoryController::class, 'getSlug'])->name('category.slug');
        Route::post('/category/{id}/remove-image', [CategoryController::class, 'removeMainImage'])->name('category.remove.image');

        Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('subCategoryList');
        Route::get('/sub-category/create', [SubCategoryController::class, 'create'])->name('subCategory.create');
        Route::post('/sub-category/create', [SubCategoryController::class, 'store'])->name('subCategory.save');
        Route::get('/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('subCategory.edit');
        Route::post('/sub-category/edit/{id}', [SubCategoryController::class, 'update'])->name('subCategory.update');
        Route::post('/sub-category/delete/{id}', [SubCategoryController::class, 'delete'])->name('subCategory.delete');
        Route::get('/sub-category/get-slug', [SubCategoryController::class, 'getSlug'])->name('subCategory.slug');

        Route::get('/services', [ServiceController::class, 'index'])->name('serviceList');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('service.create.form');
        Route::post('/services/create', [ServiceController::class, 'save'])->name('service.create');
        Route::get('/services/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('/services/edit/{id}', [ServiceController::class, 'update'])->name('service.edit.update');
        Route::post('/services/delete/{id}', [ServiceController::class, 'delete'])->name('service.delete');
        Route::get('/services/get-slug', [ServiceController::class, 'getSlug'])->name('service.slug');
        Route::get('/services/sub-categories', [ServiceController::class, 'getSubCategories'])->name('service.subcategories');
        Route::post('/service/{id}/remove-image', [ServiceController::class, 'removeMainImage'])->name('service.remove.image');
        Route::post('/service/{id}/remove-gallery-image', [ServiceController::class, 'removeGalleryImage'])->name('service.remove.gallery.image');

        Route::get('/companies', [CompanyController::class, 'index'])->name('companyList');
        Route::get('/companies/create', [CompanyController::class, 'create'])->name('company.create.form');
        Route::post('/companies/create', [CompanyController::class, 'save'])->name('company.create');
        Route::get('/companies/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::post('/companies/edit/{id}', [CompanyController::class, 'update'])->name('company.edit.update');
        Route::post('/companies/delete/{id}', [CompanyController::class, 'delete'])->name('company.delete');
        Route::get('/companies/get-slug', [CompanyController::class, 'getSlug'])->name('company.slug');
        Route::get('/companies/sub-categories', [CompanyController::class, 'getSubCategories'])->name('company.subcategories');
        Route::post('/company/{id}/remove-image', [CompanyController::class, 'removeMainImage'])->name('company.remove.image');
        Route::post('/company/{id}/remove-gallery-image', [CompanyController::class, 'removeGalleryImage'])->name('company.remove.gallery.image');

        Route::get('/settings',[SettingsController::class,'index'])->name('settings.index');
        Route::post('/settings',[SettingsController::class,'save'])->name('settings.save');
    });
});

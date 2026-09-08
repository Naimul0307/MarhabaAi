<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('name_ar')->nullable();
            $table->string('slug');
            $table->text('short_desc')->nullable();
            $table->text('short_desc_ar')->nullable();
            $table->text('description')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_keywords_ar')->nullable();
            $table->integer('status')->default(1);
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->json('additional_videos_links')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('videos_link')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}

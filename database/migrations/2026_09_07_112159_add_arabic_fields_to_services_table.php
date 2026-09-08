<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('name_ar')->nullable()->after('name');
            $table->text('short_desc_ar')->nullable()->after('short_desc');
            $table->text('description_ar')->nullable()->after('description');
            $table->string('meta_title_ar')->nullable()->after('meta_title');
            $table->text('meta_description_ar')->nullable()->after('meta_description');
            $table->text('meta_keywords_ar')->nullable()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            //
        });
    }
};

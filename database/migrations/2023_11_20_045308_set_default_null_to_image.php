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
        Schema::table('articles', function (Blueprint $table) {
            $table->string('preview_image_path')->nullable()->change();
            $table->string('bg_image_path')->nullable()->change();
        });
        Schema::table('novelties', function (Blueprint $table) {
            $table->string('preview_image_path')->nullable()->change();
            $table->string('bg_image_path')->nullable()->change();
        });
        Schema::table('promos', function (Blueprint $table) {
            $table->string('preview_image_path')->nullable()->change();
            $table->string('bg_image_path')->nullable()->change();
        });
        Schema::table('partners', function (Blueprint $table) {
            $table->string('image_path')->nullable()->change();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image_path')->nullable()->change();
        });
        Schema::table('rewards', function (Blueprint $table) {
            $table->string('image_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('preview_image_path')->change();
            $table->string('bg_image_path')->change();
        });
        Schema::table('novelties', function (Blueprint $table) {
            $table->string('preview_image_path')->change();
            $table->string('bg_image_path')->change();
        });
        Schema::table('promos', function (Blueprint $table) {
            $table->string('preview_image_path')->change();
            $table->string('bg_image_path')->change();
        });
        Schema::table('partners', function (Blueprint $table) {
            $table->string('image_path')->change();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image_path')->change();
        });
        Schema::table('rewards', function (Blueprint $table) {
            $table->string('image_path')->change();
        });
    }
};

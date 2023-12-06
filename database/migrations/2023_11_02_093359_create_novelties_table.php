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
        Schema::create('novelties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('content');
            $table->string('preview_image_path');
            $table->string('bg_image_path');
            $table->integer('time_to_read');
            $table->boolean('show');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novelties');
    }
};

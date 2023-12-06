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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('category_slug_title')->default('Партнеры');
            $table->string('category_slug_description')->default('Мы сотрудничаем со следующими партнерами, которые предоставляют данную продукцию');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('category_slug_title');
            $table->dropColumn('category_slug_description');
        });
    }
};

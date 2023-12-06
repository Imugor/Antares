<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('index_years');
            $table->json('index_popular_categories')->nullable();
            $table->json('index_promo')->nullable();
            $table->json('index_projects')->nullable();
            $table->json('index_reviews')->nullable();
            $table->json('index_partners')->nullable();
            $table->json('index_vacancies')->nullable();
            
            $table->string('vacancy_title');
            $table->string('vacancy_description');
            $table->json('vacancy_advantage')->nullable();
            $table->timestamps();
        });

        $settings = new Setting();
        $settings->index_years = 15;
        $settings->vacancy_title = 'Преимущества работы в Антарес';
        $settings->vacancy_description = 'Компания ООО Антарес, ведущий поставщик отделочных материалов, рада пригласить вас на работу в нашу команду.';
        $settings->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

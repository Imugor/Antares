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
            $table->string('footer_link_tg')->default('/');
            $table->string('footer_link_vk')->default('/');
            $table->string('footer_link_inst')->default('/');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('footer_link_tg');
            $table->dropColumn('footer_link_vk');
            $table->dropColumn('footer_link_inst');
        });
    }
};

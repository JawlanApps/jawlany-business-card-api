<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('design_settings', function (Blueprint $table) {
            $table->id();
            $table->string('landing_background_image')->nullable();
            $table->json('landing_title')->nullable();
            $table->json('landing_subtitle')->nullable();
            $table->string('menu_logo')->nullable();
            $table->string('menu_background_color')->default('#ffffff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_settings');
    }
};

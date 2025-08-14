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
        Schema::connection('tracker')->create('tracker_geoip', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->double('latitude')->nullable()->index();
            $table->double('longitude')->nullable()->index();

            $table->string('country_code', 2)->nullable()->index();
            $table->string('country_code3', 3)->nullable()->index();
            $table->string('country_name')->nullable()->index();
            $table->string('region', 2)->nullable();
            $table->string('city', 50)->nullable()->index();
            $table->string('postal_code', 20)->nullable();
            $table->bigInteger('area_code')->nullable();
            $table->double('dma_code')->nullable();
            $table->double('metro_code')->nullable();
            $table->string('continent_code', 2)->nullable();

            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('tracker')->dropIfExists('tracker_geoip');
    }
};

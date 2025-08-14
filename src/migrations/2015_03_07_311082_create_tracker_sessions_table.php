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
        Schema::connection('tracker')->create('tracker_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('uuid')->unique()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('device_id')->nullable()->index();
            $table->unsignedBigInteger('agent_id')->nullable()->index();
            $table->string('client_ip')->index();
            $table->unsignedBigInteger('referer_id')->nullable()->index();
            $table->unsignedBigInteger('cookie_id')->nullable()->index();
            $table->unsignedBigInteger('geoip_id')->nullable()->index();
            $table->boolean('is_robot');

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
        Schema::connection('tracker')->dropIfExists('tracker_sessions');
    }
};

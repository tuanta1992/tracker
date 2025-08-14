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
        Schema::connection('tracker')->create('tracker_log', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('session_id')->index();
            $table->unsignedBigInteger('path_id')->nullable()->index();
            $table->unsignedBigInteger('query_id')->nullable()->index();
            $table->string('method', 10)->index();
            $table->unsignedBigInteger('route_path_id')->nullable()->index();
            $table->boolean('is_ajax');
            $table->boolean('is_secure');
            $table->boolean('is_json');
            $table->boolean('wants_json');
            $table->unsignedBigInteger('error_id')->nullable()->index();

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
        Schema::connection('tracker')->dropIfExists('tracker_log');
    }
};

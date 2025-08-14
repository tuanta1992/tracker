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
        Schema::connection('tracker')->table('tracker_sessions', function (Blueprint $table) {
            $table->foreign('language_id')
                ->references('id')
                ->on('tracker_languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('tracker')->table('tracker_sessions', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
        });
    }
};

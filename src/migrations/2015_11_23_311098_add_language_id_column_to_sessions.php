<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'tracker_sessions';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->unsignedBigInteger('language_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->dropColumn('language_id');
        });
    }
};

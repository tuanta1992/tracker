<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'tracker_log';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->unsignedInteger('referer_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->dropColumn('referer_id');
        });
    }
};

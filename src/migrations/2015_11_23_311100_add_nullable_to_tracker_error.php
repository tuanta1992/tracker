<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'tracker_errors';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->string('code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->string('code')->nullable(false)->change();
        });
    }
};

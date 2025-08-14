<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'tracker_query_arguments';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
                $table->string('value')->nullable()->change();
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
                $table->string('value')->change();
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
};

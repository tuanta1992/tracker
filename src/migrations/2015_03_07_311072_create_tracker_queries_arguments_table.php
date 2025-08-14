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
        Schema::connection('tracker')->create('tracker_query_arguments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('query_id')->index();
            $table->string('argument')->index();
            $table->string('value')->index();
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
        Schema::connection('tracker')->dropIfExists('tracker_query_arguments');
    }
};

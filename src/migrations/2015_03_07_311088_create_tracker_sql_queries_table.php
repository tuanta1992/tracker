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
        Schema::connection('tracker')->create('tracker_sql_queries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('sha1', 40)->index();
            $table->text('statement');
            $table->double('time')->index();
            $table->unsignedInteger('connection_id');

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
        Schema::connection('tracker')->dropIfExists('tracker_sql_queries');
    }
};

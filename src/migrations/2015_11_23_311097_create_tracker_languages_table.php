<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'tracker_languages';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('tracker')->create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('preference')->index();
            $table->string('language-range')->index();

            $table->unique(['preference', 'language-range']);

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
        Schema::connection('tracker')->dropIfExists($this->table);
    }
};

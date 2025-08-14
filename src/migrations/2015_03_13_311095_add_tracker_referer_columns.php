<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'tracker_referers';
    private $foreign = 'tracker_referers_search_terms';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $connection = 'tracker';

        // Thêm cột mới
        Schema::connection($connection)->table($this->table, function (Blueprint $table) {
            $table->string('medium')->nullable()->index();
            $table->string('source')->nullable()->index();
            $table->string('search_terms_hash')->nullable()->index();
        });

        // Thêm foreign key
        Schema::connection($connection)->table($this->foreign, function (Blueprint $table) {
            $table->foreign('referer_id', 'tracker_referers_referer_id_fk')
                ->references('id')->on('tracker_referers')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $connection = 'tracker';

        // Xóa các cột
        Schema::connection($connection)->table($this->table, function (Blueprint $table) {
            $table->dropColumn(['medium', 'source', 'search_terms_hash']);
        });

        // Xóa foreign key
        Schema::connection($connection)->table($this->foreign, function (Blueprint $table) {
            $table->dropForeign('tracker_referers_referer_id_fk');
        });
    }
};

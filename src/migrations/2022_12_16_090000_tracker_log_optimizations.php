<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private $table = 'tracker_log';

    public function up(): void
    {
        // Chuyển cột method sang ENUM
        DB::connection('tracker')->statement(
            "ALTER TABLE {$this->table} MODIFY COLUMN method ENUM('GET', 'POST', 'HEAD', 'PUT', 'DELETE', 'UNKNOWN') DEFAULT 'UNKNOWN'"
        );

        // Xoá index không cần thiết
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->dropIndex('tracker_log_updated_at_index');
        });
    }

    public function down(): void
    {
        // Rollback ENUM về varchar
        DB::connection('tracker')->statement(
            "ALTER TABLE {$this->table} MODIFY COLUMN method VARCHAR(255) DEFAULT 'UNKNOWN'"
        );

        // Tạo lại index
        Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
            $table->index('updated_at');
        });
    }
};

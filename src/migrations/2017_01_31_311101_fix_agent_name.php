<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table = 'tracker_agents';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Bỏ unique cũ trên name
            Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
                $table->dropUnique('tracker_agents_name_unique');
            });

            // Thay đổi name thành mediumText
            Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
                $table->mediumText('name')->change();
            });

            // Tạo dummy unique trên id để không lỗi khi cần unique
            Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
                $table->unique('id', 'tracker_agents_name_unique');
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
                $table->string('name', 255)->change();
                $table->unique('name');
            });
        } catch (\Exception $e) {
            // Tránh lỗi rollback nếu không khả thi
        }
    }
};

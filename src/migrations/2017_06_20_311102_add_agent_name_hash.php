<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PragmaRX\Tracker\Vendor\Laravel\Models\Agent;

return new class extends Migration
{
    private $table = 'tracker_agents';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            // Bỏ unique cũ trên name và thêm cột name_hash
            Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
                $table->dropUnique('tracker_agents_name_unique');
                $table->string('name_hash', 65)->nullable();
            });

            // Tạo hash cho dữ liệu hiện tại
            Agent::all()->each(function ($agent) {
                $agent->name_hash = hash('sha256', $agent->name);
                $agent->save();
            });

            // Tạo unique trên name_hash
            Schema::connection('tracker')->table($this->table, function (Blueprint $table) {
                $table->unique('name_hash');
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
                $table->dropUnique('tracker_agents_name_hash_unique');
                $table->dropColumn('name_hash');
                $table->mediumText('name')->unique()->change();
            });
        } catch (\Exception $e) {
            // Tránh lỗi rollback nếu không khả thi
        }
    }
};

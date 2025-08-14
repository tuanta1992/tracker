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
        $connection = 'tracker';

        Schema::connection($connection)->table('tracker_query_arguments', function (Blueprint $table) {
            $table->foreign('query_id')
                ->references('id')->on('tracker_queries')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_route_paths', function (Blueprint $table) {
            $table->foreign('route_id')
                ->references('id')->on('tracker_routes')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_route_path_parameters', function (Blueprint $table) {
            $table->foreign('route_path_id')
                ->references('id')->on('tracker_route_paths')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_referers', function (Blueprint $table) {
            $table->foreign('domain_id')
                ->references('id')->on('tracker_domains')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_sessions', function (Blueprint $table) {
            $table->foreign('device_id')
                ->references('id')->on('tracker_devices')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('agent_id')
                ->references('id')->on('tracker_agents')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('referer_id')
                ->references('id')->on('tracker_referers')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('cookie_id')
                ->references('id')->on('tracker_cookies')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('geoip_id')
                ->references('id')->on('tracker_geoip')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_log', function (Blueprint $table) {
            $table->foreign('session_id')
                ->references('id')->on('tracker_sessions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('path_id')
                ->references('id')->on('tracker_paths')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('query_id')
                ->references('id')->on('tracker_queries')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('route_path_id')
                ->references('id')->on('tracker_route_paths')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('error_id')
                ->references('id')->on('tracker_errors')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_events_log', function (Blueprint $table) {
            $table->foreign('event_id')
                ->references('id')->on('tracker_events')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('class_id')
                ->references('id')->on('tracker_system_classes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('log_id')
                ->references('id')->on('tracker_log')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_sql_query_bindings_parameters', function (Blueprint $table) {
            $table->foreign('sql_query_bindings_id', 'tracker_sqlqb_parameters')
                ->references('id')->on('tracker_sql_query_bindings')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::connection($connection)->table('tracker_sql_queries_log', function (Blueprint $table) {
            $table->foreign('log_id')
                ->references('id')->on('tracker_log')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('sql_query_id')
                ->references('id')->on('tracker_sql_queries')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Foreign keys sẽ tự động bị xóa khi drop tables theo đúng thứ tự
    }
};

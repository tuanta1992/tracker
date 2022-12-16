<?php

use PragmaRX\Tracker\Support\Migration;

class TrackerLogOptimizations extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function migrateUp()
    {
        $connection = $this->manager->connection(config('tracker.connection'));

        // Convert to enum
        $connection->statement("ALTER TABLE tracker_log MODIFY COLUMN method ENUM('GET', 'POST', 'HEAD', 'PUT', 'DELETE', 'UNKNOWN') default 'UNKNOWN'");

        // Remove unnecessary column
        $this->builder->table('tracker_log', function($table) {
            $table->dropIndex('tracker_log_updated_at_index');
            $table->dropColumn('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function migrateDown()
    {

    }
}

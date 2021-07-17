<?php

namespace PragmaRX\Tracker\Vendor\Laravel\Models;

class EventLog extends Base
{
    protected $table = 'tracker_events_log';

    protected $fillable = [
        'event_id',
        'class_id',
        'class_ref_id',
        'log_id',
        'extra_data',
    ];

    protected $casts = [ 'extra_data' => 'array' ];
}

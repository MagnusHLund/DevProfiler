<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

/*
This profiler is fully manual.
It is controlled by the hooks: devprofiler_start_profiler, devprofiler_checkpoint, devprofiler_stop_profiler
This profiler provides a timestamp of when a checkpoint is hit or it stops.
The time starts when the profiler starts.
*/
class DevProfiler_Manual_Profiler extends DevProfiler_Abstract_Profiler
{

    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function start_profiler() {}

    public function set_checkpoint() {}

    public function stop_profiler() {}
}

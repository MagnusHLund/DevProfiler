<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

/*
This profiler is manually started and stopped.
While active, it listens to all hooks. It logs when it is manually stopped.
*/
class DevProfiler_Manual_Hook_Listener_Profiler extends DevProfiler_Abstract_Profiler
{
    private $is_active = false;

    public function __construct($name)
    {
        parent::__construct($name);
    }

    public function listen_to_hooks()
    {
        if ($this->is_active) {
        }
    }

    public function stop_profiler()
    {
        $this->is_active = false;
    }
}

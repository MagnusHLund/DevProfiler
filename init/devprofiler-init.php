<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

class DevProfiler_Init
{
    public function __construct()
    {
        $settings = new DevProfiler_Settings();
        if (!$settings->is_ip_allowed()) {
            return;
        }

        new DevProfiler_Profiler_Creator();
    }
}

<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

class DevProfiler_Init
{
    public function __construct()
    {
        $settings = DevProfiler_Settings::get_instance();
        if (!$settings->is_ip_allowed()) {
            return;
        }

        require_once plugin_dir_path(__FILE__) . "init/devprofiler-manager.php";
    }
}

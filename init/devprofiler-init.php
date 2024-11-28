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

        if (!$settings->should_run_on_wp_cron() && defined('DOING_CRON') && DOING_CRON) {
            return;
        }

        require_once plugin_dir_path(__FILE__) . "init/devprofiler-manager.php";
    }
}

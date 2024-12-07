<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

class DevProfiler_Settings
{
    // These values will be configurable later.
    // For now, they are just hardcoded.

    private $allowed_ips = [];
    private $use_automatic_hook_listener = true;
    private $run_on_wp_cron = false;
    private $run_on_ajax = false;
    private $max_parameter_length = 200;

    private static $instance = null;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function is_ip_allowed()
    {
        if (empty($this->allowed_ips)) {
            return true;
        }

        $client_ip = $_SERVER['REMOTE_ADDR'];

        if (in_array($client_ip, $this->allowed_ips)) {
            return true;
        }

        return false;
    }

    public function should_use_automatic_hook_listener()
    {
        return $this->use_automatic_hook_listener;
    }

    public function should_run_on_wp_cron()
    {
        return $this->run_on_wp_cron;
    }

    public function should_run_on_ajax()
    {
        return $this->run_on_ajax;
    }

    public function get_max_parameter_length()
    {
        return $this->max_parameter_length;
    }

    public function set_allowed_ip_addresses() {}

    public function set_use_automatic_hook_listener() {}

    public function set_run_on_wp_cron() {}

    public function set_run_on_ajax() {}

    public function set_max_parameter_length($max_length) {}
}

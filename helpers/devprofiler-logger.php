<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

class DevProfiler_Logger
{
    private static $instance = null;

    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function log_output($output, $file_name)
    {
        $log = "id: {$hook_id} ($hook_name) executed in $formatted_time seconds, with parameter ($param), called in (" . $called_by['func'] . " in " . $called_by['file'] . ")\n";

        $directory = plugin_dir_path(__FILE__) . "log/";
        file_put_contents($directory . "$file_name.log", $log, FILE_APPEND);
    }

    public function does_log_exist($log_name)
    {
        $directory = plugin_dir_path(__FILE__) . "log/";
        return file_exists($directory . "$log_name.log");
    }
}

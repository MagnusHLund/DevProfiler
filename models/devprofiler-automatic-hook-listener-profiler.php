<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

/*
This profiler is enabled in settings. It is active by default.
The profiler can be manually stopped. It can not be started again.
It logs its output, after each hook registration.
*/
class DevProfiler_Automatic_Hook_Listener_Profiler extends DevProfiler_Abstract_Profiler
{
    private $is_active = true;
    private $hooks = [];
    private $id = 0;

    public function __construct()
    {
        $name = "automatic_hook_listener_profiler";
        parent::__construct($name);
    }

    public function listen_to_hooks()
    {
        add_action('all', function ($hook_name, $parameter) {
            if ($this->is_active) {
                $this->id++; // Move this

                if (!isset($this->hooks[$hook_name])) {
                    $this->hooks[$hook_name]['time'] = microtime(true);
                    $this->hooks[$hook_name]['id'] = $this->id;
                } else {
                    $end_time = microtime(true);
                    $elapsed_time = $this->calculate_time($this->hooks[$hook_name]['time'], $end_time);

                    $parameter = $this->format_parameter($parameter);

                    $called_by = $this->get_caller_function_name(6, true);
                    $hook_id = $this->hooks[$hook_name]['id'];
                }
            }
        });
    }

    public function stop_profiler()
    {
        $this->is_active = false;
    }
}

if (!isset($action_start_times[$hook_name])) {
} else {
    $log = "id: {$hook_id} ($hook_name) executed in $formatted_time seconds, with parameter ($param), called in (" . $called_by['func'] . " in " . $called_by['file'] . ")\n";
    file_put_contents(__DIR__ . "/profiler.log", $log, FILE_APPEND);
    $id--;
    unset($action_start_times[$hook_name]);
}

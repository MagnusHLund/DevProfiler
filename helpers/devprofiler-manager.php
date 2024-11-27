<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

class DevProfiler_Manager
{
    public static function create_profiler($name, $listen_to_all_hooks = false)
    {
        if (self::get_profiler_by_name($name) === null) {
            return null;
        }

        if ($listen_to_all_hooks) {
            return new DevProfiler_Manual_Hook_Listener_Profiler($name);
        }

        return new DevProfiler_Manual_Profiler($name);
    }

    public static function get_profiler_by_name($name)
    {
        $profiler = DevProfiler_Abstract_Profiler::get_instance($name);

        if (isset($profiler)) {
            return $profiler;
        }

        return null;
    }

    public static function get_profiler_type($profiler)
    {
        try {
            return get_class($profiler);
        } catch (\Error) {
            return null;
        }
    }
}

function devprofiler_start_profiling($profiler_name, $listen_to_wp_hooks = false)
{
    $profiler = DevProfiler_Manager::create_profiler($profiler_name, $listen_to_wp_hooks);

    if ($profiler !== null) {
        $profiler->start_profiler();
    }
}

function devprofiler_set_checkpoint($profiler_name)
{
    $profiler = DevProfiler_Manager::get_profiler_by_name($profiler_name);

    if (DevProfiler_Manager::get_profiler_type($profiler) === "DevProfiler_Manual_Profiler") {
        $profiler->set_checkpoint();
    }
}

function devprofiler_stop_profiling($profiler_name)
{
    $profiler = DevProfiler_Manager::get_profiler_by_name($profiler_name);

    if ($profiler !== null) {
        $profiler->stop_profiler();
    }
}

if (DevProfiler_Settings::get_instance()->should_use_automatic_hook_listener()) {
    (new DevProfiler_Automatic_Hook_Listener_Profiler())->listen_to_hooks();
}

<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

function devprofiler_start_profiling($profiler_name, $listen_to_wp_hooks = false)
{
    do_action('devprofiler_start_profiling', $profiler_name, $listen_to_wp_hooks);
}

function devprofiler_profile_point($profiler_name)
{
    do_action('devprofiler_profile_point', $profiler_name);
}

function devprofiler_stop_profiling($profiler_name,)
{
    do_action('devprofiler_stop_profiling', $profiler_name);
}

function devprofiler_get_profiler_by_name($profiler_name)
{
    if (class_exists('DevProfiler_Profiler_Creator')) {
        $profiler_creator = new DevProfiler_Profiler_Creator();
    }
}

add_action('devprofiler_start_profiling', 'start_profiling');
add_action('devprofiler_profile_point', 'profile_point');
add_action('devprofiler_stop_profiling', 'stop_profiling');

class DevProfiler_Profiler_Creator
{
    // WIP
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

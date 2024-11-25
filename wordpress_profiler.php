<?php
/*
Plugin Name: test
Plugin URI: test
Description: test
Version: test
Author: test
Author URI:
License:
License URI:
*/

/*
function start_profiling($label) {
    global $profiling_data;
    if (!isset($profiling_data)) {
        $profiling_data = [];
        $profiling_data['start_time'] = microtime(true);
        $profiling_data['stack'] = [];
    }
    if(!isset($profiling_data["is_finished"])) {
 
        $func = get_function_name(6);
        $profiling_data['stack'][] = [
            'label' => $label . ' (start)',
            'time' => microtime(true),
            'elapsed' => 0,             
            'func' => $func
        ];
    }
    
}
 
function profile_point($label) {
    global $profiling_data;
    $current_time = microtime(true);
    $func = get_function_name(6);
    $profiling_data['stack'][] = [
        'label' => $label,
        'time' => $current_time,
        'elapsed' => $current_time - $profiling_data['start_time'],
        'func' => $func
    ];
}
 
function stop_profiling($label) {
    global $profiling_data;
    $end_time = microtime(true);
    $func = get_function_name(6);
    $profiling_data['is_finished'] = true;
    $profiling_data['stack'][] = [
        'label' => $label . ' (end)',
        'time' => $end_time,
        'elapsed' => $end_time - $profiling_data['start_time'],
        'func' => $func
    ];
    $profiling_data['end_time'] = $end_time;
    $profiling_data['total_time'] = $end_time - $profiling_data['start_time'];
    log_profiling_data($profiling_data);
    unset($profiling_data);
}
 
function log_profiling_data($data) {
    $log = "Total Execution Time: " . $data['total_time'] . " seconds\n";
    $log .= "Call Stack:\n";
    foreach ($data['stack'] as $point) {
        $log .= $point['label'] . ": " . "(func, " . $point['func'] . ") " . $point['elapsed'] . " seconds\n";
    }
    file_put_contents('/var/www/public/web/test-log.log', $log, FILE_APPEND);
}
 
function get_function_name($previous_function_index) {
    $dbt=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $previous_function_index + 1);
    return isset($dbt[$previous_function_index]['function']) ? $dbt[$previous_function_index]['function'] : null;
}
 
function my_custom_start_profiling($label) {
    do_action('my_custom_start_profiling', $label);
}
 
function my_custom_profile_point($label) {
    do_action('my_custom_profile_point', $label);
}
 
function my_custom_stop_profiling($label) {
    do_action('my_custom_stop_profiling', $label);
}
 
add_action('my_custom_start_profiling', 'start_profiling');
add_action('my_custom_profile_point', 'profile_point');
add_action('my_custom_stop_profiling', 'stop_profiling');
*/
// Version 2:

$userIP = $_SERVER['REMOTE_ADDR'];
$allowedIP = 'x.x.x.x';

if ($userIP === $allowedIP || true) {
    add_action('all', function ($hook_name) {
        global $profiling_data;
        if (!isset($profiling_data)) {
            $profiling_data = [];
            $profiling_data['start_time'] = microtime(true);
            $profiling_data['stack'] = [];
        }

        if (!isset($profiling_data['stack'])) {
            $profiling_data['stack'][] = [
                'isFirst' => "true",
                'time' => microtime(true),
                'elapsed' => 0,
                'func' => $hook_name
            ];
        } else {
            global $profiling_data;
            $current_time = microtime(true);
            $profiling_data['stack'][] = [
                'time' => $current_time,
                'elapsed' => $current_time - $profiling_data['start_time'],
                'func' => $hook_name
            ];
        }
    });

    function stop_profiling($label)
    {
        global $profiling_data;
        $end_time = microtime(true);
        $func = get_function_name(6);
        $profiling_data['stack'][] = [
            'label' => $label . ' (end)',
            'time' => $end_time,
            'elapsed' => $end_time - $profiling_data['start_time'],
            'func' => $func
        ];
        $profiling_data['end_time'] = $end_time;
        $profiling_data['total_time'] = $end_time - $profiling_data['start_time'];
        log_profiling_data($profiling_data);
        unset($profiling_data);
    }

    function log_profiling_data($data)
    {
        $log = "Total Execution Time: " . $data['total_time'] . " seconds\n";
        $log .= "Call Stack:\n";
        foreach ($data['stack'] as $point) {
            $log .= $point['label'] . ": " . "(func, " . $point['func'] . ") " . $point['elapsed'] . " seconds\n";
        }
        file_put_contents('/var/www/public/web/test-log.log', $log, FILE_APPEND);
    }

    function get_function_name($previous_function_index)
    {
        $dbt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $previous_function_index + 1);
        return isset($dbt[$previous_function_index]['function']) ? $dbt[$previous_function_index]['function'] : null;
    }

    function my_custom_stop_profiling($label)
    {
        do_action('my_custom_stop_profiling', $label);
    }

    add_action('my_custom_stop_profiling', 'stop_profiling');
}

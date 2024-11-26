<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

class DevProfiler_Hook_Listener_Profiler extends DevProfiler_Abstract_Profiler
{

    public function __construct() {}

    public static function get_instance($name)
    {
        if (!isset(self::$instances[$name])) {
            self::$instances[$name] = new self($name);
        }

        return self::$instances[$name];
    }

    public function listen_to_hooks() {}
}

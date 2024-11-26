<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

abstract class DevProfiler_Abstract_Profiler
{
    protected $name;
    protected $stack_trace;
    protected static $instances = [];

    public function __construct($name)
    {
        $this->name = $name;
        self::$instances[$name] = $this;
    }

    public function stop_profiler() {}
}

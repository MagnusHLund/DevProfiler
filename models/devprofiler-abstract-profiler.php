<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

abstract class DevProfiler_Abstract_Profiler
{
    protected $name;
    protected $stack_trace;
    private static $instances = [];

    private $logger = null;
    private $profiler_log_name;

    public function __construct($name)
    {
        $this->name = $name;
        self::$instances[$name] = $this;

        $this->logger = DevProfiler_Logger::get_instance();

        $this->create_profiler_log_name();
    }

    public static function get_instance($name)
    {
        return self::$instances[$name];
    }

    abstract public function stop_profiler();

    protected function get_caller_function_name($stack_trace_lines, $file = false)
    {
        $dbt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $stack_trace_lines + 1);
        if ($file) {
            return [
                "func" => isset($dbt[$stack_trace_lines]['function']) ? $dbt[$stack_trace_lines]['function'] : null,
                "file" => isset($dbt[$stack_trace_lines]['file']) ? $dbt[$stack_trace_lines]['file'] : null
            ];
        }
        return isset($dbt[$stack_trace_lines]['function']) ? $dbt[$stack_trace_lines]['function'] : null;
    }

    protected function calculate_time($start_time, $end_time)
    {
        $elapsed_time = $end_time - $start_time;
        return sprintf('%.15f', $elapsed_time);
    }

    protected function format_parameter($parameter)
    {
        if (!is_string($parameter)) {
            $variableType = gettype($parameter);
            $parameter = "Not convertable value, originally $variableType.";
        }

        if (strlen($parameter) > 200) {
            $parameter = "Parameter is too long to be output.";
        }

        return $parameter;
    }

    protected function log_output($output)
    {
        $this->logger->log_output($output, $this->profiler_log_name);
    }

    private function create_profiler_log_name()
    {
        $log_id = 0;

        do {
            $log_name = "devprofiler-" . $this->name . "-$log_id";
            $log_id++;
        } while ($this->logger->does_log_exist($log_name));

        $this->profiler_log_name = $log_name;
    }
}

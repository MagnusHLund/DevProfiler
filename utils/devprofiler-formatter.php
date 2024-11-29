<?php

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

class DevProfiler_Formatter
{

    /**
     * @param array $parameters Associative array.
     */
    public static function format_output($parameters)
    {
        $formatted_output = "";
        $formatted_output .= array_map(function ($key, $value) {
            return "$key: ($value)";
        }, $parameters);

        return $formatted_output;
    }
}

<?php
/*
Plugin Name: DevProfiler
Plugin URI:
Description: DevProfiler is a tool to debug your WordPress installation for slow loading loading.
Version: 0.1
Author: Magnus Lund
Author URI:
License: MIT
License URI:
*/

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . "init/devprofiler-init.php";

new DevProfiler_Init();
<?php

class DevProfiler_Settings
{
    private $allowed_ips = [];

    public function is_ip_allowed()
    {
        if (empty($this->allowed_ips)) {
            return true;
        }

        $client_ip = $_SERVER['REMOTE_ADDR'];

        if (in_array($client_ip, $this->allowed_ips)) {
            return true;
        }

        return false;
    }
}

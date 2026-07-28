<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Helper to quickly access application settings from database.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

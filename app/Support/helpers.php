<?php

use App\Settings\GeneralSettings;

if (!function_exists('settings')) {
    /**
     * Get the general settings instance.
     *
     * @return \App\Settings\GeneralSettings
     */
    function settings(): GeneralSettings
    {
        return app(GeneralSettings::class);
    }
}

<?php namespace October\PS;

use System\Classes\PluginBase;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */
class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name' => 'October Demo',
            'description' => 'Provides features used by the provided demonstration theme.',
            'author' => 'Alexey Bobkov, Samuel Georges',
            'icon' => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            \October\PS\Components\Todo::class => 'psTodo',
            \October\PS\Components\BackendLink::class => 'backendLink'
        ];
    }
}

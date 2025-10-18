<?php namespace October\PS;

use Backend\Facades\Backend;
use Cms\Classes\Theme;
use Log;
use October\PS\Models\Site;
use Request;
use System\Classes\PluginBase;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */
class Plugin extends PluginBase
{


    public function boot() {
        $httpHost = Request::getHost();
        Log::info('HTTP Host: ' . $httpHost);
        if($httpHost && $site = Site::where('domain', $httpHost)->first()) {
            // Set the active theme
            $theme = $site->theme ? $site->theme : 'demo-theme';
            Theme::setActiveTheme($theme);
        }
    }

    public function pluginDetails()
    {
        return [
            'name' => 'PS',
            'description' => 'Provides features used by the provided demonstration theme.',
            'author' => 'Sergey Prihodchenko',
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

    public function registerSettings() {
        return [
            'sites' => [
                'label'       => 'Сайты',
                'description' => 'Управление списком сайтов.',
                'category'    => 'PS',
                'icon'        => 'icon-globe',
                'class'       => Site::class,
                'order'       => 500,
                'keywords'    => 'sites domain theme',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'sites' => [
                'label'       => 'Сайты',
                'url'         => Backend::url('october/ps/site'),
                'icon'        => 'icon-leaf',
                'permissions' => ['october.ps.*'],
                'order'       => 500,
            ],
        ];
    }
}

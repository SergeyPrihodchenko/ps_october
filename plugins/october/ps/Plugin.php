<?php namespace October\PS;

use Backend\Facades\Backend;
use October\PS\Models\Site;
use Request;
use System\Classes\PluginBase;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */
class Plugin extends PluginBase
{


    public function boot() {
        if(env('APP_ENV') === 'production') {
            \Event::listen('cms.theme.getActiveTheme', function () {
                $httpHost = Request::getHost();
                $site = Site::where('domain', $httpHost)->first();

                if ($site && $site->theme) {
                    return $site->theme;
                }

                return 'demo';
            });
        } else {
            \Event::listen('cms.theme.getActiveTheme', function () {
                return 'olimp-urypinsk';
            });
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

<?php namespace October\PS\Models;

use Cms\Classes\Theme;
use Model;
use System\Models\SiteDefinition;

/**
 * Site Model
 *
 * @link https://docs.octobercms.com/4.x/extend/system/models.html
 */
class Site extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'october_ps_sites';

    public $timestamps = false;

    /**
     * @var array rules for validation
     */
    public $rules = [
        'domain' => 'required|nullable|unique:october_ps_sites|string',
        'theme' => 'required|nullable|string',
    ];

    public $belongsTo = [
        'site' => [
            SiteDefinition::class,
            'key' => 'site_id'
        ],
    ];

    public function beforeCreate()
    {

        $site = new SiteDefinition();

        $site->attributes = [
            'name' => $this->domain,
            'theme' => $this->theme,
            'code' => $this->theme,
            'is_enabled' => true,
            'is_enabled_edit' => true,
            //'is_restricted' => false,
            'is_custom_url' => true,
            'app_url' => 'https://' . $this->domain,
        ];

        $site->save();

        $this->site_id = $site->id;
    }

    public function beforeUpdate()
    {

        $site = $this->site;

        $site->attributes = [
            'name' => $this->domain,
            'theme' => $this->theme,
            'code' => $this->domain,
            'is_enabled' => true,
            'is_enabled_edit' => true,
            //'is_restricted' => false,
            'is_custom_url' => true,
            'app_url' => 'https://' . $this->domain,
        ];

        $site->save();
    }


    public function getThemeOptions(): array
    {
        $result = [
            '' => '— ' . __('Use Default') . ' —',
        ];

        foreach (Theme::all() as $theme) {
            if ($theme->isLocked()) {
                $label = $theme->getConfigValue('name') . ' (' . $theme->getDirName() . '*)';
            } else {
                $label = $theme->getConfigValue('name') . ' (' . $theme->getDirName() . ')';
            }

            $result[$theme->getDirName()] = $label;
        }

        return $result;
    }
}
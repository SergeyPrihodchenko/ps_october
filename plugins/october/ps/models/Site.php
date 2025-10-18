<?php namespace October\PS\Models;

use Model;

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

    public function getThemeOptions()
    {
        $themes = \Cms\Classes\Theme::allAvailable();
        $idDirs = [];
        foreach ($themes as $theme) {
            $idDirs[$theme->getId()] = $theme->getDirName();
        }
        return $idDirs;
    }
}

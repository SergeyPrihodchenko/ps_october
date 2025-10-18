<?php namespace October\PS\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Site Backend Controller
 *
 * @link https://docs.octobercms.com/4.x/extend/system/controllers.html
 */
class Site extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['october.ps.site'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.PS', 'ps', 'site');
    }
}

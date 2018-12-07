<?php namespace Watchlearn\Vuerentacar\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Dates extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Watchlearn.Vuerentacar', 'main-menu-item', 'side-menu-item2');
    }
}

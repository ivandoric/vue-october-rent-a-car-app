<?php namespace Watchlearn\Vuerentacar\Models;

use Model;

/**
 * Model
 */
class Vehicle extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /* Relations */

    public $belongsToMany = [
        'locations' => [
            'Watchlearn\Vuerentacar\Models\Location',
            'table' => 'watchlearn_vuerentacar_vehicles_locations',
            'order' => 'title'
        ],
        'dates' => [
            'Watchlearn\Vuerentacar\Models\Date',
            'table' => 'watchlearn_vuerentacar_vehicles_dates',
            'order' => 'pickup'
        ]
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'watchlearn_vuerentacar_vehicles';
}

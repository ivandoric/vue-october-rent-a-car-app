<?php namespace Watchlearn\Vuerentacar\Models;

use Model;

/**
 * Model
 */
class Vehicle extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
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

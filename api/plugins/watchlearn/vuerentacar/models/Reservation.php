<?php namespace Watchlearn\Vuerentacar\Models;

use Model;

/**
 * Model
 */
class Reservation extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $belongsTo = [
        'vehicle' => 'Watchlearn\Vuerentacar\Models\Vehicle',
        'user' => 'RainLab\User\Models\User'
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'watchlearn_vuerentacar_reservations';
}

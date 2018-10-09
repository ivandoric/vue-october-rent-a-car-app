<?php

use Watchlearn\Vuerentacar\Models\Vehicle;

Route::get('vehicles', function() {
    $vehicles = Vehicle::all();
    return $vehicles;
});

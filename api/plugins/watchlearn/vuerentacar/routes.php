<?php

use Watchlearn\Vuerentacar\Models\Vehicle;
use Watchlearn\Vuerentacar\Models\Location;

Route::get('vehicles', function() {
    $vehicles = Vehicle::all();
    return $vehicles;
});

Route::get('locations', function() {
    $locations = Location::all();
    return $locations;
});

Route::get('locations/list', function() {
    $locations = Location::all();

    foreach($locations as $location) {
        $location['label'] = $location['title'];
        $location['value'] = $location['id'];
        unset($location['title']);
        unset($location['id']);
        unset($location['slug']);
    }

    return $locations;
});

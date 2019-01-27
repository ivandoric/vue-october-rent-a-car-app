<?php

use Watchlearn\Vuerentacar\Models\Vehicle;
use Watchlearn\Vuerentacar\Models\Location;
use Watchlearn\Vuerentacar\Models\Reservation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

Route::get('vehicles', function() {
    $vehicles = Vehicle::with(['image','locations', 'dates'])->get();
    return $vehicles;
});

Route::get('vehicles/filter/{id}', function($id) {
    $vehicles = Vehicle::whereHas('locations', function($query) use ($id){
        $query->where('id', '=', $id);
    })->get();

    return $vehicles;
});


Route::middleware(['jwt.auth'])->group(function () {
    Route::post('create-reservation', function(Request $request) {
        $reservation = new Reservation;
        $reservation->pickup = $request->pickup;
        $reservation->dropoff = $request->dropoff;
        $reservation->user_id = $request->user_id;
        $reservation->vehicle_id = $request->vehicle_id;
        $reservation->save();
        return response()->json('Reservation Created!');
    });
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

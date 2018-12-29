<?php

use Watchlearn\Vuerentacar\Models\Vehicle;
use Watchlearn\Vuerentacar\Models\Location;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

Route::post('save-user', function(Request $request) {
    $user = new User;

    $user->name = $request->name;
    $user->surname = $request->surname;
    $user->email = $request->email;
    $user->username = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();

    return 'Done!';
});

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

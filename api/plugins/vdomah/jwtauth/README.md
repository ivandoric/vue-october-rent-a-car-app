# JWT Auth API

JSON Web Token Authentication for your OctoberCMS API integrated with RainLab.User

This plugin provides token based authentication to your application. Is based on the awesome package [JSON Web Token Authentication for Laravel & Lumen](https://github.com/tymondesigns/jwt-auth) by Sean Tymon.

### Requirements

RainLab.User plugin

### Installation

After plugin installation you need to copy /plugins/vdomah/jwtauth/config/auth.php to {root}/config/auth.php, otherwise you'll got an error.

### Endpoints 

The plugin provides 2 endpoints: /api/login and /api/signup.

/api/login

Expects 2 parameters to receive: email and password. Makes attempt to authenticate and returns token if succeeded. Also the basic user info is included in the response.

/api/signup

Expects 3 parameters to receive: email, password and password_confirmation. Tries to create a user and returns token if succeeded. The user info is included in the response.

/api/refresh

Expects 1 parameter: token. Tries to refresh the token and return the new token.

/api/invalidate

Expects 1 parameter: token. Tries to invalidate the given token - this can be used as an extra precaution to log the user out

### How to use this in another plugin?

Simply add `->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken')` to the end of the route in the plugin's routes.php

eg: 
```
Route::post('test', function (\Request $request) {
   return response()->json(('The test was successful'));
})->middleware('\Tymon\JWTAuth\Middleware\GetUserFromToken');
```

Then when making the request set the header "Authorization" to "Bearer `{yourToken}`"

### How to define own set of user attributes in response?

For sign up and sign in add corresponding methods getAuthApiSignupAttributes or/and getAuthApiSigninAttributes to User model by extending it in your plugin's boot method:

```
    User::extend(function($model) {
        $model->addDynamicMethod('getAuthApiSignupAttributes', function () use ($model) {
            return [
                'my-attr' => $model->my_attr,
            ];
        });
    });
```
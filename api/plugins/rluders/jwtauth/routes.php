<?php

Route::group(
    [
        'prefix' => 'api/auth',
        'namespace' => 'RLuders\JWTAuth\Http\Controllers',
        'middleware' => ['api'],
    ],
    function () {

        Route::post(
            'login',
            'AuthController@authenticate'
        )->name('api.auth.login');

        Route::post(
            'register',
            'AuthController@register'
        )->name('api.auth.register');

        Route::post(
            'account-activation',
            'AuthController@accountActivation'
        )->name('api.auth.account-activation');

        Route::post(
            'forgot-password',
            'AuthController@forgotPassword'
        )->name('api.auth.forgot-password');

        Route::post(
            'reset-password',
            'AuthController@resetPassword'
        )->name('api.auth.reset-password');

        Route::post(
            'refresh-token',
            'AuthController@refreshToken'
        )->name('api.auth.refresh-token');

        Route::middleware(['jwt.auth'])->group(
            function () {

                Route::get(
                    'me',
                    'AuthController@getUser'
                )->name('api.auth.me');
            }
        );

    }
);

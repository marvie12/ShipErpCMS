<?php
if (getenv('APP_ENV') == 'production') {
    URL::forceSchema('https');
}

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::filter('allowOrigin', 'CORSFilter@checkOrigin');

Route::get('/', array(
    'as' =>'login.index',
    'uses' =>'LoginController@index'
));
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@doLogout');

//provider
Route::group(
    array('prefix' => 'provider', 'before' => 'auth'),
    function () {
        Route::get('/',array(
            'as' => 'provider.index',
            'uses' => 'ProviderController@index')
        );

        Route::get('/add',
            array(
                'as' => 'add.provider',
                'uses' => 'ProviderController@add'
            )
        );

        Route::get('/edit/{id?}',
            array(
                'as' => 'edit.provider',
                'uses' => 'ProviderController@edit'
            )
        )->where(
            array('id' => '([0-9]+)')
        );

        Route::post('/process', array('as' => 'process.provider', 'uses' => 'ProviderController@process'));

        Route::post('/delete', array('uses' => 'ProviderController@delete'));
    }
);

//users
Route::group(
    array('prefix' => 'users', 'before' => 'auth'),
    function () {
        Route::get('/',array(
            'as' => 'user.index',
            'uses' => 'UsersController@index')
        );

        Route::get('/add',array('uses' => 'UsersController@add'));

        Route::get('/edit/{id?}',
            array(
                'as' => 'edit.user',
                'uses' => 'UsersController@edit'
            )
        )->where(
            array('id' => '([0-9]+)')
        );

        Route::post('/process', array('as' => 'process.user', 'uses' => 'UsersController@process'));

        Route::post('/delete', array('uses' => 'UsersController@delete'));
    }
);
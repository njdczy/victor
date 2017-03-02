<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/sign', 'SignLogscontroller@index');

    $router->resources([
        'vcats'  => 'VcatsController',
        'vusers'  => 'VusersController',
        'conferences'  => 'ConferencesController',
    ]);

    $router->post('vusers/enter', 'VusersController@enter');
});

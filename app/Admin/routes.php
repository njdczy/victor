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
        'salesmen' => 'SalesmenController',
        'managers' => 'ManagersController',
        'hotels' => 'HotelsController',
        'provinces' => 'ProvincesController',
        'posts' => 'PostsController',
        'jxs' => 'JxsController',
    ]);

    $router->post('vusers/enter', 'VusersController@enter');
    $router->patch('del_card', 'VusersController@delCard');
    $router->post('vusers/send_sms', 'VusersController@sendSms');

    $router->post('/sign', 'SignController@index');

    $router->get('/enter', 'Entercontroller@index');
    $router->get('/import', 'HomeController@import');
});

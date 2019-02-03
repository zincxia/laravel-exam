<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix' => 'Api',
    'namespace' => 'App\\Api\\Controllers',
    'middleware' => [],
], function (Router $router) {
    $router->get('WangEditorImageUpload', 'UploadController@WangEditorImageUpload');
    $router->post('SummernoteImageUpload', 'UploadController@SummernoteImageUpload');
});
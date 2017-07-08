<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return 'Base Url';
});

$app->post('split', 'Controller@split_pdf');

$app->get('join', function () use ($app) {
    return split_pdf();
});

$app->post('upload_file', 'UploadController@upload');

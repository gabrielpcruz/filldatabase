<?php

use App\Http\Api\Connection;
use App\Http\Api\Tables;
use App\Http\Site\Documentation;
use App\Http\Site\Home;
use Slim\App;

use App\Http\Api\Home as HomeApi;

return function (App $app) {
    // Docs
    $app->redirect('/', '/docs');
    $app->get('/docs', [Documentation::class, 'index']);

    // Api
    $app->get('/v1/home', [HomeApi::class, 'index']);
    $app->get('/home', [Home::class, 'index']);


    $app->post('/connection', [Connection::class, 'create']);
    $app->get('/tables', [Tables::class, 'tables']);
};

<?php

use App\Http\Api\Connection;
use App\Http\Api\FillDataBase;
use App\Http\Api\Insert;
use App\Http\Api\Tables;
use App\Http\Site\Home;

use App\Http\Site\Login;
use Slim\App;

return function (App $app) {
    // Docs
    $app->redirect('/', '/home');

    $app->get('/home', [Home::class, 'index']);

    $app->get('/login', [Login::class, 'index']);
    $app->post('/login', [Login::class, 'login']);
    $app->get('/logout', [Login::class, 'logout']);

    $app->post('/connection', [Connection::class, 'create']);
    $app->get('/tables', [Tables::class, 'tables']);
    $app->post('/insert', [Insert::class, 'insert']);

    $app->get('/filldatabase', [FillDataBase::class, 'fill']);
};

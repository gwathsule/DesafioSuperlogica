<?php

require_once '../vendor/autoload.php';

use PlugRoute\Http\RequestCreator;
use PlugRoute\PlugRoute;
use PlugRoute\RouteContainer;
use App\Controller;

$route = new PlugRoute(new RouteContainer(), RequestCreator::create());

$route->notFound(function () {
    echo 'Not found';
});
/** @see \App\Controller::insert() */
$route->post('/', Controller::class.'@insert');

/** @see \App\Controller::index() */
$route->get('/', Controller::class.'@index');

/** @see \App\Controller::select() */
$route->get('/select/{informacao}', Controller::class.'@select');

$route->on();
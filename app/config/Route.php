<?php

// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');


$router->get('/', 'User@home');



// debug
$router->get('/data', 'User@test');


$router->mount('/dashboard', function () use ($router) {

    $router->get('/', function () {
        view('dashboard/home');
    });

    $router->get('/submit', function () {
        echo 'submit new';
    });
});

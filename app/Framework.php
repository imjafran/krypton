<?php

# Session
if(!session_id()) session_start();

define('HOME', (stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));


# PHP Micro Framework by Jafran Hasan 
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

require_once __DIR__ . '/core/Functions.php';

require_once __DIR__ . '/core/Router.php';


# Create Router instance
$router = new \App\Router();

if (file_exists(__DIR__ . '/router/web.php')) {
    include_once __DIR__ . '/router/web.php';
}

if (file_exists(__DIR__ . '/router/api.php')) {

    $router->mount('/api', function () use ($router) {
        include_once __DIR__ . '/router/api.php';
    });

    
}


# enable ajax
$router->get('/ajax/{method}?', 'Ajax@_controll');


# Run it
$router->set404(function () {
    error(404);
});

$router->run();






# ini_set('display_errors', 1);
# ini_set('display_startup_errors', 1);
# error_reporting(E_ALL);

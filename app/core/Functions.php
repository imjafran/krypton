<?php

// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');




function home()
{
    return HOME;
}



function base($url = '')
{
    if ($url)
        $url = trim($url, '/') . DIRECTORY_SEPARATOR;
    return home() . $url;
}



function asset($url = '')
{
    return base('public/assets/' . $url);
}



function storage($url = '')
{
    return base('public/storage/' . $url);
}


// autoload 
function autoload_Cores($class_name)
{
    $class_name = str_replace('App\\', '', $class_name);
    if (file_exists(BASE_PATH . 'app/core/' . $class_name . '.php')) {
        require_once  BASE_PATH . 'app/core/' . $class_name . '.php';
    }
}



function autoload_Controllers($class_name)
{
    if (file_exists(BASE_PATH . 'app/controller/' . $class_name . '.php')) {
        require_once  BASE_PATH . 'app/controller/' . $class_name . '.php';
    }
}



spl_autoload_register('autoload_Cores');
spl_autoload_register('autoload_Controllers');



// view function

function view($template = '', $args = [], $pretty = false)
{
    if (file_exists(BASE_PATH . '/view/' . $template . '.php')) {
        if (is_array($args) && !empty($args))
            extract($args);
        include_once BASE_PATH . '/view/' . $template . '.php';
    } else {
        // do nothing   
    }
}




// function get db 

function db()
{
    return App\Database::getInstance();
}



function error($response_code = 404)
{
    $server_errors = [
        404 => 'Route Not Found',
        405 => 'Method Not Allowed'
    ];

    $response_code = array_key_exists($response_code, $server_errors) ? $response_code : 404;

    $response_message = $server_errors[$response_code];

    http_response_code($response_code);

    header('HTTP/1.1 ' . $response_code . ' ' . $response_message);

    if (file_exists(BASE_PATH . 'app/templates/extra/Error.php')) {
        include_once BASE_PATH . 'app/templates/extra/Error.php';
    }
}



// csrf function 
function get_csrf()
{
    $token = $_SESSION['token'] ?? bin2hex(random_bytes(32));
    setcookie('_csrf', $token, time() + 84600 * 30, HOME);
    return $token;
}



function csrf()
{
    echo '<input type="hidden" name="_csrf" id="_csrf" value="' . get_csrf() . '">';
}



function verify_csrf($token = false)
{
    return ($token && hash_equals($_SESSION['token'], $_POST['token'])) ? true : false;
}

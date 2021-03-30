<?php

// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');
header('content-type: application/json');

class Ajax extends App\Controller
// class User
{
    public function _controll($method = '_controll')
    {
        // if (!Request::ajax()) {
        //     $this->response(false, 'Ajax not detected');
        // }
        if ($method != '_controll' && method_exists($this, $method)) {
            return $this->$method();
        } else {
            $this->response(false, 'Invalid Ajax Request');
        }
    }

    public function test()
    {
        $this->response(true, 'ajax enabled');
    }
}

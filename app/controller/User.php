<?php

// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');

class User extends App\Controller
// class User
{
    public function home()
    {
        view('home');
    }







    public function test()
    {
        $data = [
            'name' => 'Alpha',
            'version' => 1,
            'updated_at' => time()
        ];

        // print_r((object) $data);
        // exit();



        echo json_encode($data);
    }
}

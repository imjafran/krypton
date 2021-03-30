<?php
// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');

//  change database information 
return [
    //current development environment
    "env" => "development",
    //Localhost
    "development" => [
        "host" => "localhost",
        "database" => "",
        "username" => "root",
        "password" => ""
    ],
    //Server
    "production"  => [
        "host" => "",
        "database" => "",
        "username" => "",
        "password" => ""
    ]
];

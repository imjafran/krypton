<?php

namespace App;

// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');

class Controller
{
    public $db = null;
    public function __construct()
    {
        // something
        $this->db = Database::getInstance();
    }

    public function view($template = '', $args = [], $pretty = false)
    {
        view($template, $args, $pretty);
    }

    public function response($status = false, $data = NULL, $response_code = false)
    {
        header('content-type: application/json');
        $out = [
            'status' => $status
        ];

        if ($response_code) {
            $out['response_code'] = $response_code;
            http_response_code($response_code);
        }

        if (!empty($data)) {
            is_array($data) ? $out["data"] = $data : $out["message"] = $data;
        }

        echo json_encode($out);
        exit();
    }
    function csrf($token)
    {
        return verify_csrf($token);
    }
}

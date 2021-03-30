<?php

// direct script
defined('BASE_PATH') or die('Direct Script not Allowed');

class Term
{
    protected $db = false;
    public function __construct()
    {
        $this->db = App\Database::getInstance();
        return $this;
    }
    public function getTerm($name)
    {
        $term = $this->db->table('terms')->where('name', $name)->get()->first();
        if ($term) {
            try {
                return json_decode($term->term_object);
            } catch (Exception $e) {
                return $term->term_object;
            }
        }
        return false;
    }

    public static function get($name = 'core')
    {
        return (new self)->getTerm($name);
    }
}

<?php

namespace Core;


class H
{
    public static function d($data, $stop = 0)
    {
        echo '<pre style="border: 1px solid black">';
        if ($stop == 1) {
            var_dump($data);
            exit;
        } else {
            var_dump($data);
        }
        echo '</pre>';
    }

    public static function current_page()
    {
        $current_page = $_SERVER['REQUEST_URI'];

        if ($current_page == PROOT || $current_page == PROOT . '/home/index') {
            $current_page = PROOT . 'home';
        }
        return $current_page;
    }

    public static function get_object_properties($obj)
    {
        return get_object_vars($obj);
    }

    public static function convert_name()
    {
        $db = DB::getInstance();
        $users = $db->query("SELECT * FROM users")->results();

        $array = json_decode(json_encode($users), true);

        return $array;
    }

    // CONVERT TRUE FALSE
    public static function convert_number($column)
    {

        if ($column == 0) {
            return 'Yes';
        } else {
            return 'No';
        }
    }
}

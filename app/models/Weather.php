<?php

namespace App\Models;

use Core\DB;

use Core\Model;

class Weather extends Model
{

    public $id, $user_id, $name, $isbn, $description, $image;


    public function __construct()
    {
        $table = 'books';
        parent::__construct($table);
    }


    public function find_all_books()
    {
        return $this->find();
    }

    //THIS FUNCTION RETURN WIND POSITION
    public static function weather($deg)
    {
        if (($deg >= 0 && $deg <= 23)
            || ($deg >= 337 && $deg <= 360)
        ) {
            return $result = 'North';
        } else if (($deg >= 24 && $deg <= 68)) {
            return $result = 'Northeast';
        } else if (($deg >= 69 && $deg <= 113)) {
            return $result = 'East';
        } else if (($deg >= 114 && $deg <= 158)) {
            return $result = 'Southeast';
        } else if (($deg >= 159 && $deg <= 203)) {
            return $result = 'South';
        } else if (($deg >= 204 && $deg <= 248)) {
            return $result = 'Southwest';
        } else if (($deg >= 249 && $deg <= 293)) {
            return $result = 'West';
        } else if (($deg >= 294 && $deg <= 336)) {
            return $result = 'Northwest';
        } else {
            return $result = '';
        }
    }
}

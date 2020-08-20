<?php

namespace App\Models;

use Core\DB;

use Core\Model;

class Invoicing extends Model
{

    public function __construct()
    {

        $table = 'books';
        parent::__construct($table);
    }
}

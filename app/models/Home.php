<?php

namespace App\Models;

use Core\DB;
use Core\Model;

class Home extends Model
{
    public $user_id, $name, $isbn, $description, $image;

    public function __construct()
    {
        $table = 'books';
        parent::__construct($table);
    }

    public function display_name()
    {
        return $this->name;
    }

    public function find_all_by_user_id($user_id, $params = [])
    {
        // see on current user contacts
        //remove $params
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];
        return $this->find($conditions);
    }


    public function find_all()
    {
        return $this->find();
    }


    public function find_by_id_and_user_id($contact_id, $user_id, $params = [])
    {
        $conditions = [
            'conditions' => 'id = ?',
            'bind' => [$contact_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }

    public function delete_favourite($id)
    {
        // get favourite books
        $db = DB::getInstance();

        $sql = "DELETE FROM favourite WHERE user_id = " . Users::current_user()->id . "  AND book_id = " . $id;

        $favouriteQ = $db->query($sql)->results();
    }
}

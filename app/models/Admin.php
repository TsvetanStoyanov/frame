<?php

namespace App\Models;

use Core\Model;
use Core\FH;
class Admin extends Model
{
    public $id, $username, $fname, $lname, $email, $acl, $img;
    public $deleted = 0;

    
    public function __construct()
    {
        // table of Database
        $table = 'users';
        parent::__construct($table);
        // if want delete permanent set FALSE
        // $this->_soft_delete = true;
    }

    public function find_all_users()
    {
        return $this->find();
    }

    public function find_all_by_user_id($user_id, $params = [])
    {
        // see on current user contacts
        //remove $params
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];
        return $this->find();
    }

    // GET USERS NAMES
    public function display_name()
    {
        return $this->fname . ' ' . $this->lname;
    }

    // GET LOGGED USER
    public function current_user()
    {
        return Users::current_user()->fname . ' ' . Users::current_user()->lname;
    }

    public function acl()
    {
        return Users::current_user()->acl;
    }

    public function id()
    {
        return Users::current_user()->id;
    }

    // CONVERT TRUE FALSE
    public function convert_number()
    {
        $num = $this->deleted;
        if ($num == 0) {
            return 'Yes';
        } else {
            return 'No';
        }
    }

    public function find_by_id_and_user_id($contact_id, $user_id, $params = [])
    {
        $conditions = [
            'conditions' => 'id = ?',
            'bind' => [$contact_id, $user_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }
}

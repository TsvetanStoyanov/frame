<?php

namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;

class Contacts extends Model
{
    public $id, $user_id, $fname, $lname, $email, $address, $address2, $city, $state, $post_code;
    public $home_phone, $cell_phone, $work_phone, $deleted = 0;

    public function __construct()
    {
        $table = 'contacts';
        parent::__construct($table);
        // if want delete permanent set FALSE
        $this->_soft_delete = true;
    }


    public function validator()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'msg' => 'First Name is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'msg' => 'Last Name is required']));
        $this->runValidation(new MaxValidator($this, ['field' => 'fname', 'msg' => 'First Name must be less than 156 characters.', 'rule' => 155]));
        $this->runValidation(new MaxValidator($this, ['field' => 'lname', 'msg' => 'Last Name must be less than 156 characters.', 'rule' => 155]));
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


        // // see all contacts
        // $conditions = [
        //     'conditions' => 'user_id = ?',
        //     'bind' => [$user_id]
        // ];
        // $conditions = array_merge($params);
        // return $this->find($conditions);
    }

    // display result

    public function display_name()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public function find_by_id_and_user_id($contact_id, $user_id, $params = [])
    {
        $conditions = [
            'conditions' => 'id = ? AND user_id = ?',
            'bind' => [$contact_id, $user_id]
        ];
        $conditions = array_merge($conditions, $params);
        return $this->find_first($conditions);
    }

    public function display_address()
    {
        $address = '';

        if (!empty($this->address)) {
            $address .= $this->address . '</br>';
        }
        if (!empty($this->address2)) {
            $address .= $this->address2 . '</br>';
        }
        if (!empty($this->city)) {
            $address .= $this->city . ', ';
        }
        $address .= $this->state . ' ' . $this->post_code . '</br>';

        return $address;
    }

    public function display_address_label()
    {
        $html = $this->display_name() . '<br>';
        $html .= $this->display_address();
        return $html;
    }
}

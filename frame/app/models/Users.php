<?php


namespace App\Models;

use Core\Model;
use App\Models\UserSessions;
use Core\Cookie;
use Core\DB;
use Core\Session;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;

class Users extends Model
{

    private $_is_logged_in, $_sessionName, $_cookieName, $_confirm;
    public static $current_logged_in_user = null;
    public $id, $username, $email, $password, $fname, $lname, $acl, $deleted = 1;

    public function __construct($user = '')
    {
        $table = 'users';
        parent::__construct($table);

        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_soft_delete = true;

        if ($user != '') {
            if (is_int($user)) {
                $u = $this->_db->find_first('users', ['conditions' => 'id = ?', 'bind' => [$user]], 'App\Models\Users');
            } else {
                $u = $this->_db->find_first('users', ['conditions' => 'username = ?', 'bind' => [$user]], 'App\Models\Users');
            }
            if ($u) {
                foreach ($u as $key => $v) {
                    $this->$key = $v;
                }
            }
        }
    }

    public function validator()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'msg' => 'First Name is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'msg' => 'Last Name is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'Email is required.']));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'You must provide a valid email address.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'email', 'rule' => 150, 'msg' => 'Email must be at less than 150 characters.']));
        $this->runValidation(new MinValidator($this, ['field' => 'username', 'rule' => 6, 'msg' => 'Username must be at least 6 characters.']));
        $this->runValidation(new MaxValidator($this, ['field' => 'username', 'rule' => 150, 'msg' => 'Username must be at less than 150 characters.']));
        $this->runValidation(new UniqueValidator($this, ['field' => 'username', 'msg' => 'That username already exist. Please choose a new one']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => 'Password is required.']));
        $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 6, 'msg' => 'Password must be at less than 6 characters.']));
        if ($this->is_new()) {
            $this->runValidation(new MatchesValidator($this, ['field' => 'password', 'rule' => $this->_confirm, 'msg' => 'Passwords do not match']));
        }
    }

    public function before_save()
    {
        if ($this->is_new()) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }
    }

    public function findByUsername($username)
    {
        return $this->find_first(['conditions' => "username = ?", 'bind' => [$username]]);
    }
    public function findByEmail($email)
    {
        return $this->find_first(['conditions' => "email = ?", 'bind' => [$email]]);
    }

    public static function current_user()
    {
        if (!isset(self::$current_logged_in_user) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $U = new Users((int) Session::get(CURRENT_USER_SESSION_NAME));
            self::$current_logged_in_user = $U;
        }
        return self::$current_logged_in_user;
    }

    public static function favourite()
    {

        $db = DB::getInstance();

        $fields = [
            'user_id' => self::$current_logged_in_user->id,
            'book_id' => $_GET['favourite']
        ];

        $favouriteQ = $db->insert('favourite', $fields);
    }

    public static function all_users()
    {
        $db = DB::getInstance();
        $users = $db->query("SELECT * FROM users")->results();

        $array = json_decode(json_encode($users), true);
        return $array;
    }

    public function login($rememberMe = false)
    {
        Session::set($this->_sessionName, $this->id);

        if ($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            // $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->_db->insert('user_sessions', $fields);
        }
    }

    public static function login_user_from_cookie()
    {
        $userSession = UserSessions::getFromCookie();

        if ($userSession && $userSession->user_id != '') {
            $user = new self((int) $userSession->user_id);
            if ($user) {

                $user->login();
            }

            return $user;
        }
        return;
    }

    public function logout()
    {
        $userSession = UserSessions::getFromCookie();
        if ($userSession) $userSession->delete();
        $userSession->delete();
        Session::delete(CURRENT_USER_SESSION_NAME);
        //CHECK COOKIE EXIST
        if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        //RETURN NULL LOGGET USER 
        self::$current_logged_in_user = null;
        return true;
    }

    public function acls()
    {
        if (empty($this->acl)) return [];


        // return json_decode($this->acl, true);
        return $this->acl;
    }

    public function set_confirm($value)
    {
        $this->_confirm = $value;
    }

    public function get_confirm()
    {
        return $this->_confirm;
    }
}

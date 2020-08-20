<?php

namespace Core;

class Session
{
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function uagent_no_version()
    {
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regex = '/\/[a-zA-Z0-9.]+/';
        $new_string = preg_replace($regex, '', $uagent);
        return $new_string;
    }

    /**
     * Adds a session alert message
     * @method addMsg
     * @param string $type can be primary, secondary, success, danger, warning, info or dark
     * @param string $msg the message you want to display in the alert
     */
    public static function add_msg($type, $msg)
    {
        $sessionName = 'alert-' . $type;
        self::set($sessionName, $msg);
    }


    public static function display_msg()
    {
        $alerts = ['alert-primary', 'alert-secondary', 'alert-success', 'alert-danger', 'alert-warning', 'alert-info', 'alert-dark'];
        $html = '';
        foreach ($alerts as $alert) {
            if (self::exists($alert)) {
                $html .= '<div class="alert ' . $alert . ' alert-dismissible" role="alert">';
                $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                $html .= self::get($alert);
                $html .= '</div>';

                self::delete($alert);
            }
        }
        return $html;
    }
}

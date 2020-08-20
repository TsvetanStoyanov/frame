<?php

namespace Core;

class View
{
    protected $_head, $_body, $_site_title = SITE_TITLE, $_output_buffer, $_layout = DEFAULT_LAYOUT;

    public function __construct()
    {
    }

    public function render($view_name)
    {
        $view_array = explode('/', $view_name);
        $view_string = implode(DS, $view_array);

        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $view_string . '.php')) {
            include(ROOT . DS . 'app' . DS . 'views' . DS . $view_string . '.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php');
        } else {
            die('The view \"' . $view_name . '\" does not exist');
        }
    }

    public function content($type)
    {
        if ($type == 'head') {
            return $this->_head;
        } else if ($type == 'body') {
            return $this->_body;
        }
        return false;
    }


    public function start($type)
    {
        $this->_output_buffer = $type;
        ob_start();
    }

    public function end()
    {
        if ($this->_output_buffer == 'head') {
            $this->_head = ob_get_clean();
        } else if ($this->_output_buffer == 'body') {
            $this->_body = ob_get_clean();
        } else {
            die('You must furst run the start method');
        }
    }

    public function site_title()
    {
        if ($this->_site_title == '') return SITE_TITLE;
        return $this->_site_title;
    }

    public function set_site_title($title)
    {
        $this->_site_title = $title;
    }

    public function set_layout($path)
    {
        $this->_layout = $path;
    }

    public function insert($path)
    {
        include ROOT . DS . 'app' . DS  . 'views' . DS . $path . '.php';
    }

    public function partial($group, $partial)
    {
        include ROOT . DS . 'app' . DS . 'views' . DS . $group . DS . 'partials' . DS . $partial . '.php';
    }
}

<?php

namespace Core;

use Core\Session;

class FH
{

    public static function input_block($type, $label, $name, $value = '', $input_attr = [], $div_attr = [], $required = '')
    {
        $div_string = self::stringify_attr($div_attr);
        $input_string = self::stringify_attr($input_attr);

        $html = '<div ' . $div_string . '>';
        $html .= '<label for="' . $name . '">' . $label . '</label>';
        $html .= '<input type="' . $type . '" id="' . $name . '"  name="' . $name . '" value="' . $value . '" ' . $input_string .  $required . ' />';
        $html .= '</div>';

        return $html;
    }

    //     <div class="btn btn-default btn-file">
    //     <i class="fa fa-paperclip"></i> Attachment
    //     <input type="file" name="attachment">
    // </div>


    public static function attach($label, $value = '')
    {

        $html = '<div class="btn btn-default btn-file">';
        $html .= '<i class="fa fa-paperclip"></i> Attachment';
        $html .= '<input type="file" name="attachment">';
        $html .= '</div>';

        return $html;
    }


    public static function modal($type, $title = '', $text)
    {
        $html =  '<div class="callout callout-' . $type . '">';
        $html .= '<h4>' . $title . '</h4>';
        $html .=    '<p>' . $text . '</p>';
        $html .= '</div>';
        return $html;
    }




    public static function textarea($label, $name, $value = '', $input_attr = [], $div_attr = [], $required = '')
    {
        $div_string = self::stringify_attr($div_attr);

        $html = '<div ' . $div_string . '>';
        $html .= '<label for="' . $name . '">' . $label . '</label>';
        $html .= '<textarea id="description" name="description" class="form-control">' . $value . '</textarea>';
        $html .= '</div>';

        return $html;
    }

    public static function input_dropdown($label, $name, $load_data, $value = [], $class)
    {
        $html = '<div class="' . $class . '">';
        $html .= '<div><label for="' . $label . '">' . $label . '</label> </div>';
        $html .= '<select name="' . $name . '" class="custom-select">';
        // check if role have nothing
        (!$load_data) ? $html .= '<option value="" > ' . 'Please choose' . '</option>' : '';
        foreach ($value as $key => $v) {
            $selected = '';
            if ($key === $load_data) {
                $selected = 'selected';
            }
            $html .= '<option value="' . $key . '" ' . $selected . '> ' . $v . '</option>';
        }
        $html .= '</select></div>';
        return $html;
    }

    public static function submit_tag($button_text, $input_attr = '', $div_attr = [])
    {

        $input_string = self::stringify_attr($input_attr);
        $html = '<input type="submit" value="' . $button_text . '"' . $input_string . '/>';
        return $html;
    }

    public static function href($button_text, $link, $input_attr = '')
    {

        $input_string = self::stringify_attr($input_attr);

        $html = '<a href="' . $link . '" ' . $input_string . '>' . $button_text . '</a>';
        return $html;
    }

    public static function submit_block($button_text, $input_attr = [], $div_attr = [])
    {
        $div_string = self::stringify_attr($div_attr);
        $input_string = self::stringify_attr($input_attr);

        $html = '<div' . $div_string . '>';
        $html .= '<input type="submit" value="' . $button_text . '" ' . $input_string . ' />';
        $html .= '</div>';
        return $html;
    }

    public static function checkbox_block($label, $name, $checked = false, $input_attr = [], $div_attr = [])
    {
        $div_string = self::stringify_attr($div_attr);
        $input_string = self::stringify_attr($input_attr);
        $check_string = ($checked) ? ' checked="checked"' : '';
        $html = '<div ' . $div_string . '>';
        $html .= '<label for="' . $name . '">' . $label . ' <input type="checkbox" id="' . $name . '" name="' . $name . '" value="on" ' . $check_string . $input_string . '></label>';
        $html .= '</div>';

        return $html;
    }

    public static function stringify_attr($attrs)
    {
        $string = '';

        foreach ($attrs as $key => $val) {
            $string .= ' ' . $key . '="' . $val . '"';
        }
        return $string;
    }

    public static function generate_token()
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token', $token);
        return $token;
    }

    public static function check_token($token)
    {
        return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
    }

    // security function helper
    public static function csrf_input()
    {
        return '<input type="hidden" name="csrf_token" id="csrf_token" value="' . self::generate_token() . '">';
    }

    public static function sanitize($dirty)
    {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }


    public static function posted_values($post)
    {
        $clean_array = [];

        foreach ($post as $key => $v) {
            $clean_array[$key] = self::sanitize($v);
        }
        return $clean_array;
    }

    public static function displayErrors($errors)
    {
        $hasErrors = (!empty($errors)) ? 'has-errors' : '';

        $html = '<div class="bg-danger form-errors"><ul class="has-errors ' . $hasErrors . '">';
        foreach ($errors as $field => $error) {
            $html .= '<li class="p-1 text-white">' . $error . '</li>';
            $html .= '<script>jQuery("document").ready(function(){jQuery("#' . $field . '").parent().closest("div").addClass("has-error");});</script>';
        }
        $html .= '</ul></div>';

        return $html;
    }
}

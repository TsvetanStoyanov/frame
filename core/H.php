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


    public static function image($target_dir)
    {
        $result = '';
        $target_file = $target_dir . ($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            // var_dump($_FILES["fileToUpload"]);
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
            //Sorry, your file is too large.
            $result = 1;
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
            $result = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                // echo "Sorry, there was an error uploading your file.";
            }
        }
        return $result;
    }
}

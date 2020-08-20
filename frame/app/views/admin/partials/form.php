<?php

use Core\FH;
use App\Models\Users;



?>

<?php

if (isset($_POST["submit"])) {

    $target_dir  = '/var/www/html/frame/images/admin/';

    $target_file = $target_dir . ($_FILES["fileToUpload"]["name"]);
    // var_dump($target_file);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        // var_dump($_FILES["fileToUpload"]);
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
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
}

?>


<form class="form" action="<?= $this->postAction ?>" method="post" enctype="multipart/form-data">


    <?= FH::displayErrors($this->displayErrors) ?>
    <div class="form-row">
        <!-- <?= FH::csrf_input() ?> -->
        <?= FH::input_block('text', 'First Name', 'fname', $this->admin->fname, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Last Name', 'lname', $this->admin->lname, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Email', 'email', $this->admin->email, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <!-- <?= FH::input_block('text', 'Password', 'password', $this->admin->password, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?> -->

        <?= (Users::current_user()->acl == "Admin" || Users::current_user()->acl == "Super_admin") ? FH::input_dropdown('Role', 'acl', $this->admin->acl, ['Super_admin' => 'Super_admin', 'Admin' => 'Admin', 'Client' => 'Client'], 'form-group col-md-4') : ''; ?>


        <?= (Users::current_user()->acl == "Admin" || Users::current_user()->acl == "Super_admin") ? FH::input_dropdown('Verified', 'deleted', $this->admin->deleted, ['0' => 'Yes', '1' => 'No'], 'form-group col-md-2') : '' ?>

        <?= FH::input_block('text', 'img', 'img', $this->admin->img, ['class' => 'form-control bind d-none'], ['class' => 'form-group col-md-6 d-none hide']) ?>


        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" class="fileToUpload">

        <img style="width: 100px;" src="<?= PROOT . 'images/admin' . DS . $this->admin->img ?>" alt="<?= $this->admin->fname ?> ">


        

    </div>

    <div class="col-md-12 text-right">
        <a href="<?= PROOT ?>admin/users" class="btn btn-default">Cancel</a>
        <!-- <?= FH::submit_tag('Save', ['class' => 'btn btn-primary']) ?> -->

        <input type="submit" value="Save" class="btn btn-success" name="submit">


    </div>
</form>


<script>
    $('.fileToUpload').change(function() {

        a = $(this).val();

        //   remove fakepath from upload
        var cleaned = a.replace('C:\\fakepath\\', '');
        $a = $(".bind").val(cleaned);

    });
</script>
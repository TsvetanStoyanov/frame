<?php

use Core\FH;
use app\Models\Users;
use Core\DB;
use Core\H;

?>

<?php

if (isset($_POST["submit"])) {

    $target_dir  = '/var/www/html/frame/images/';
    $target_file = $target_dir . ($_FILES["fileToUpload"]["name"]);
    // var_dump($target_file);z
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
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<form class="form" action="<?= $this->postAction ?>" method="post" enctype="multipart/form-data">

    <a href="<?= PROOT ?>books" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Back</a>

    <?= FH::displayErrors($this->displayErrors) ?>
    <div class="form-row">
        <!-- <?= FH::csrf_input() ?> -->
        <?= FH::input_block('text', 'name', 'name', $this->books->name, ['class' => 'form-control'], ['class' => 'form-group col-md-6'], 'required') ?>
        <?= FH::input_block('number', 'isbn', 'isbn', $this->books->isbn, ['class' => 'form-control'], ['class' => 'form-group col-md-6'], 'required') ?>
        <?= FH::input_block('text', 'image', 'image', $this->books->image, ['class' => 'form-control bind d-none'], ['class' => 'form-group col-md-6 d-none']) ?>
        <?= FH::textarea('description', 'description', $this->books->description, ['class' => 'form-control'], ['class' => 'form-group col-md-12'], 'required') ?>

        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" class="fileToUpload">


        <img style="width: 100px;" src="<?= PROOT . 'images' . DS . $this->books->image ?>" alt="<?= $this->books->name ?> ">


    </div>

    <div class="col-md-12 text-right">
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
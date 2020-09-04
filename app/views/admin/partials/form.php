<?php

use Core\H;
use Core\FH;
use App\Models\Users;

// show error
if (isset($this->modal)) {
    echo $this->modal;
}

?>
<script>
    // load new image onchange before save
    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.querySelector("#test").setAttribute('src', e.target.result);

            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>

<form class="form" action="<?= $this->postAction ?>" method="post" enctype="multipart/form-data">


    <?= FH::displayErrors($this->displayErrors) ?>

    <!-- <?= FH::csrf_input() ?> -->
    <div class="col-md-4">
        <?= FH::input_block('text', 'img', 'img', $this->admin->img, ['class' => 'form-control bind d-none'], ['class' => 'form-group col-md-6 d-none hide']) ?>
        <div class="btn btn-default btn-file">
            <i class="fa fa-pencil"></i> Change image
            <input type="file" name="fileToUpload" id="fileToUpload" class="fileToUpload" onchange="displayImage(this)">
        </div>

        <?php

        if ($this->admin->img) {

        ?>
            <img id="test" style="width: 30%;" src="<?= PROOT . 'images/admin' . DS . $this->admin->img ?>" alt="<?= $this->admin->fname ?>" onchange="displayImage(this)">
        <?php } else {
        ?>

            <img style="width: 30%;" src="<?= PROOT . 'images/admin/person.png' ?>" alt="person">

        <?php } ?>

    </div>

    <div class="col-md-8">

        <?= FH::input_block('text', 'First Name', 'fname', $this->admin->fname, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Last Name', 'lname', $this->admin->lname, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Email', 'email', $this->admin->email, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Old', 'old',  $this->admin->password, ['class' => 'form-control'], ['class' => 'form-group col-md-6 hide']); ?>
        <?= (Users::current_user()->acl == "Admin" || Users::current_user()->acl == "Super_admin") ? FH::input_dropdown('Role', 'acl', $this->admin->acl, ['Super_admin' => 'Super_admin', 'Admin' => 'Admin', 'Client' => 'Client'], 'form-group col-md-2') : ''; ?>
        <?= (Users::current_user()->acl == "Admin" || Users::current_user()->acl == "Super_admin") ? FH::input_dropdown('Verified', 'deleted', $this->admin->deleted, ['0' => 'Yes', '1' => 'No'], 'form-group col-md-2') : '' ?>
        <p id="button" class=" btn btn-primary" onclick="return false">Change password</p>
        <?= FH::input_block('text', 'Password', 'password',  $this->admin->password, ['class' => 'form-control'], ['class' => 'form-group col-md-6 password hide']); ?>

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

    // show password input
    $('#button').click(function() {
        $('.password').removeClass('hide');
        $('#password').val('');
    });
</script>
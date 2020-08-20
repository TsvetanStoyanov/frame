<?php  
use Core\FH;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="col-md-4 offset-md-4">
    <h3 class="text-center">Register Here</h3>
    <hr>
    <form class="form" action="" method="post">
        <?= FH::csrf_input() ?>
        <?= FH::displayErrors($this->displayErrors) ?>
        <?= FH::input_block('text', 'First Name', 'fname', $this->newUser->fname, ['class' => 'form-control'],['class' => 'text-left']) ?>
        <?= FH::input_block('text', 'Last Name', 'lname', $this->newUser->lname, ['class' => 'form-control'],['class' => 'text-left']) ?>
        <?= FH::input_block('text', 'Email', 'email', $this->newUser->email, ['class' => 'form-control'],['class' => 'text-left']) ?>
        <?= FH::input_block('text', 'User Name', 'username', $this->newUser->username, ['class' => 'form-control'],['class' => 'text-left']) ?>
        <?= FH::input_block('password', 'Password', 'password', $this->newUser->password, ['class' => 'form-control'],['class' => 'text-left']) ?>
        <?= FH::input_block('password', 'Confirm Password', 'confirm', $this->newUser->get_confirm(), ['class' => 'form-control'],['class' => 'text-left']) ?>
        <?= FH::input_block('acl', 'acl', 'acl', 'Client', ['class' => 'form-control'],['class' => 'text-left d-none']) ?>
        <!-- <?= FH::input_dropdown('Role', 'acl', $this->newUser->acl, ['Admin' => 'Admin', 'Client' => 'Client'], 'form-group col-md-12') ?> -->

        <?= FH::submit_block('Register', ['class' => 'btn btn-primary btn-large'], ['class' => 'text-right']) ?>

    </form>
</div>
<?php $this->end(); ?>
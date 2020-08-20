<?php

use Core\FH;
?>
<?php $this->start('head') ?>
<?php $this->end() ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="md-12 font-weight-normal">Log In</h3>

            <form class="form-signin" action="<?php echo PROOT ?>register/login" method="post">
                <?= FH::csrf_input() ?>

                <?= FH::displayErrors($this->displayErrors) ?>

                <?= FH::input_block('text', 'Username', 'username', $this->login->username, ['class' => 'form-control'], ['class' => 'text-left']); ?>
                <!-- <?= FH::input_block('email', 'email', 'email', $this->login->email, ['class' => 'form-control'], ['class' => 'text-left']); ?> -->

                <?= FH::input_block('password', 'Password', 'password', $this->login->password, ['class' => 'form-control'], ['class' => 'text-left']); ?>

                <?= FH::checkbox_block('Remember Me', 'remember_me', $this->login->get_remember_me_checked(), [], ['class' => 'form-group']) ?>

                <?= FH::submit_block('Login', ['class' => 'btn btn-large btn-primary']) ?>


                <div class="text-right">
                    <a href="<?php echo PROOT ?>register/register" class="btn btn-success ">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->end() ?>
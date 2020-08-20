<?php  
use Core\FH;

?>

<form class="form" action="<?= $this->postAction ?>" method="post">

    <?= FH::displayErrors($this->displayErrors) ?>
    <div class="form-row">
        <?= FH::csrf_input() ?>
        <?= FH::input_block('text', 'First Name', 'fname', $this->contact->fname, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Last Name', 'lname', $this->contact->lname, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Address', 'address', $this->contact->address, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Address 2', 'address2', $this->contact->address2, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'City', 'city', $this->contact->city, ['class' => 'form-control'], ['class' => 'form-group col-md-5']) ?>
        <?= FH::input_block('text', 'State', 'state', $this->contact->state, ['class' => 'form-control'], ['class' => 'form-group col-md-3']) ?>
        <?= FH::input_block('text', 'Post Code', 'post_code', $this->contact->post_code, ['class' => 'form-control'], ['class' => 'form-group col-md-4']) ?>
        <?= FH::input_block('text', 'Email', 'email', $this->contact->email, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'cell Phone', 'cell_phone', $this->contact->cell_phone, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Home Phone', 'home_phone', $this->contact->home_phone, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'Work Phone', 'work_phone', $this->contact->work_phone, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
    </div>
    <div class="col-md-12 text-right">
        <a href="<?= PROOT ?>contacts" class="btn btn-default">Cancel</a>
        <?= FH::submit_tag('Save', ['class' => 'btn btn-primary']) ?>
    </div>
</form>
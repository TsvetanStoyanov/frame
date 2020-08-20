<?php

use Core\FH;
use app\Models\Users;
use Core\H;

?>

<form class="form" action="<?= $this->postAction ?>" method="post">

    <?= FH::displayErrors($this->displayErrors) ?>
    <div class="form-row">
        <?= FH::csrf_input() ?>
        <?= FH::input_block('text', 'date', 'date', $this->calendar->date, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <?= FH::input_block('text', 'title', 'title', $this->calendar->title, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>
        <!-- <?= FH::input_block('text', 'description', 'description', $this->calendar->description, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?> -->
        <?= FH::textarea('description', 'description', $this->calendar->description, ['class' => 'form-control'], ['class' => 'form-group col-md-6']) ?>

        <?php
        $users = Users::all_users();

        echo '<div class="form-group col-md-6"><label>user</label><select name="user_id"class="form-control form-group">';
        foreach ($users as $key => $value) {
            $selected = '';
            if ($this->calendar->user_id == $value['id']) {
                $selected = 'selected';
            }
            echo '<option id="user_id"  value="' . $value['id'] . '"' . $selected . '>' . $value['username'] . '</option>';
        }
        echo '</select></div>'

        ?>

    </div>
    <div class="col-md-12 text-right">
        <a href="<?= PROOT ?>calendar" class="btn btn-default">Cancel</a>
        <?= FH::submit_tag('Save', ['class' => 'btn btn-primary']) ?>
    </div>
</form>




<h1>TinyMCE Quick Start Guide</h1>
  <form method="post">
    <textarea id="mytextarea" name="mytextarea">
      Hello, World!
    </textarea>
  </form>
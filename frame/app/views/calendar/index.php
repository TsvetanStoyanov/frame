<?php

namespace Core;

use Core\FH;
use App\Models\Users;

?>

<?php $this->start('body'); ?>

<h2 class="text-center">Calendar</h2>
<?= FH::href('Add', 'calendar/add', ['class' => 'btn btn-success mb-5']) ?>

<table class="table table-striped table condensed table-bordered table-hover">
    <thead>
        <th>Person</th>
        <th>Date</th>
        <th>Company</th>
        <th>Description</th>
        <th></th>
    </thead>



    <tbody>
        <?php
        foreach ($this->events as $key => $event) :
             

        ?>
            <tr>
                <td><?= $event->user_id ?></td>
                <td><?= $event->date ?></td>
                <td><?= $event->title ?></td>
                <td><?= $event->description ?></td>
                <td>
                    <a href="<?= PROOT ?>calendar/edit/<?= $event->id ?>" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php $this->end(); ?>

<?php





?>
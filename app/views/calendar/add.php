<?php $this->set_site_title('Add a task'); ?>

<?php $this->start('body')  ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 well">
            <h2 class="text-center">Add a task</h2>
            <hr>
            <?php $this->partial('calendar', 'form')  ?>
        </div>
    </div>
</div>
<?php $this->end()  ?>
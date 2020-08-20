<?php $this->set_site_title('Create Book') ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Create book </h2>
            <?php $this->partial('books', 'form') ?>

        </div>
    </div>
</div>

<?php $this->end() ?>
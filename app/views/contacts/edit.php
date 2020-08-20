<?php $this->set_site_title('Edit Contact') ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Edit <?= $this->contact->display_name(); ?></h2>
            <?php $this->partial('contacts', 'form')?>
        </div>
    </div>
</div>

<?php $this->end() ?>
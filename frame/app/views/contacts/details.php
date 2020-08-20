<?php $this->set_site_title($this->contact->display_name()) ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="<?= PROOT ?>contacts" class="btn btn-xs btn-default">Back</a>
            <h2 class="text-center"><?= $this->contact->display_name() ?></h2>
        </div>

        <div class="col-md-6 text-center bg-secondary text-white">
            <p><span class="font-weight-bold">Email: </span><?= $this->contact->email; ?></p>
            <p><span class="font-weight-bold">Cell Phone: </span><?= $this->contact->cell_phone; ?></p>
            <p><span class="font-weight-bold">Home Phone: </span><?= $this->contact->home_phone; ?></p>
            <p><span class="font-weight-bold">Work Phone: </span><?= $this->contact->work_phone; ?></p>
        </div>

        <div class="col-md-6 text-center bg-secondary text-white">
            <?= $this->contact->display_address_label() ?>
        </div>
    </div>
</div>
<?php $this->end() ?>
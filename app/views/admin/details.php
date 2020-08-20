<?php $this->set_site_title($this->admin->display_name()) ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="<?= PROOT ?>admin" class="btn btn-xs btn-default">Back</a>
            <h2 class="text-center"><?= $this->admin->display_name() ?></h2>
        </div>

        <div class="col-md-6 text-center bg-secondary text-white">
            <p><span class="font-weight-bold">Username: </span><?= $this->admin->username; ?></p>
            <p><span class="font-weight-bold">Email: </span><?= $this->admin->email; ?></p>
        </div>

        <div class="col-md-6 text-center bg-secondary text-white">
            <p><span class="font-weight-bold">Full name: </span><?= $this->admin->display_name() ?></p>
            <p><span class="font-weight-bold">Role: </span><?= $this->admin->acl; ?></p>
        </div>
    </div>
</div>
<?php $this->end() ?>
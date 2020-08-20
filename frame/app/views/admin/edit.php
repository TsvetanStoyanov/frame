<?php $this->set_site_title($this->admin->display_name()) ?>

<?php $this->start('body') ?>



<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-center">Edit <?= $this->admin->display_name(); ?></h2>
                <?php $this->partial('admin', 'form') ?>
            </div>
        </div>

    </section>
</div>
<?php $this->end() ?>
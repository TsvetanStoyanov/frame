<?php $this->set_site_title($this->book->display_name()) ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center"><?= $this->book->display_name() ?></h2>
            <a href="<?= PROOT ?>books" class="btn btn-xs btn-primary mb-1">  <i class="fa fa-arrow-left"></i> Back</a>
            
            
        </div>
        
        <div class="col-md-12 text-center bg-secondary text-white">
            <hr>
            <p><span class="font-weight-bold">ISBN: </span><?= $this->book->isbn; ?></p>

            <div>
                <img style="width: 30%;" src="<?= PROOT . 'images' . DS . $this->book->image ?>" alt="<?= $this->book->name ?> ">
            </div>

            <hr>
            <p><span class="font-weight-bold">Description: </span><?= $this->book->description; ?></p>
        </div>


    </div>
</div>
<?php $this->end() ?>
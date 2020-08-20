<?php $this->set_site_title('Add a contact'); ?>

<?php $this->start('body')  ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 well">
            <h2 class="text-center">Add a Contact</h2>
            <hr>
            <?php $this->partial('contacts', 'form')  ?>
        </div>
    </div>
</div>
<?php $this->end()  ?>
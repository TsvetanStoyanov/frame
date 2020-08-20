<?php

use App\Models\Users;

echo $this->start('head');  ?>
<meta content="test" />
<?php echo $this->end(); ?>


<?php echo $this->start('body');  ?>




<div class="container">

    <h2 class="text-center page_title"><?= (Users::current_user()) ? 'My favourite books' : 'Welcome to Tsvetan\'s framework'; ?></h2>
    <!-- <div class="row">
        <?php
        if (Users::current_user()) {

            foreach ($this->home as $key => $book) :
                $end = '.';
        ?>

                <div class="col-md-4 book text-center mb-5">
                    <h2><?= $book->name ?></h2>

                    <img class="book_img" src="<?= PROOT . DS . 'images' . DS .  $book->image  ?>" alt="<?= $book->name ?>">

                    <div>
                        <i class="fa fa-barcode fa-2x"></i>
                        <p><?= $book->isbn ?></p>
                    </div>
                    <div>
                        <h3>Description</h3>
                        <p><?= substr($book->description, 0, 50) . $end  ?></p>
                    </div>
                    <a href="<?= PROOT ?>books/view/<?= $book->id ?>" class="btn btn-info btn-xs mb-2">
                        <i class="fa fa-eye"></i> View
                    </a>

                </div>
        <?php endforeach;
        } ?>
    </div> -->

    <?php if (Users::current_user()) { ?>
        <table class="table table-striped table condensed table-bordered table-hover">
            <thead>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th> <i class="fa fa-barcode"></i> ISBN</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                foreach ($this->home as $book) : ?>
                    <tr>
                        <td><?= $book->name ?></td>
                        <td>
                            <a href="<?= PROOT ?>books/view/<?= $book->id; ?>">
                                <img class="book_img" src="<?= PROOT . DS . 'images' . DS .  $book->image  ?>" alt="<?= $book->name ?>">

                            </a>

                        </td>
                        <td><?= substr($book->description, 0, 300) . $end  ?></td>
                        <td><?= $book->isbn ?></td>

                        <td>
                            <a href="<?= PROOT ?>home/delete/<?= $book->id ?>" class="btn btn-danger mb-2" onclick="if(!confirm('Are you shure ?')){return false;}">
                                <i class="fa fa-remove"></i> Remove
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
</div>

<?php  } ?>


<?php echo $this->end(); ?>
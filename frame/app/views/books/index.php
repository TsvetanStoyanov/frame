<?php

namespace Core;

use App\Controllers\BooksController;
use Core\FH;
use App\Models\Users;
use App\Models\Books;
?>

<?php $this->start('body'); ?>

<h2 class="text-center">Books</h2>

<div class="container">
    <?= (Users::current_user()->acl == "Admin") ? FH::href(' <i class="fa fa-plus"></i> Add', 'books/create', ['class' => 'btn btn-success mb-5']) : ''; ?>
    <div class="row">

        <?php
        foreach ($this->books as $key => $book) :
            $end = '.';
        ?>

            <div class="col-md-4 book text-center mb-5">
                <h2><?= $book->name ?></h2>

                <a href="<?= PROOT ?>books/view/<?= $book->id ?>"> <img class="book_img" src="<?= PROOT . DS . 'images' . DS .  $book->image  ?>" alt="<?= $book->name ?>"></a>

                <div>
                    <i class="fa fa-barcode fa-2x"></i>
                    <p><?= $book->isbn ?></p>
                </div>
                <div>
                    <h3>Description</h3>
                    <p><?= substr($book->description, 0, 50) . $end  ?></p>
                </div>
                <a href="<?= PROOT ?>books/view/<?= $book->id ?>" class="btn btn-info mb-2">
                    <i class="fa fa-eye"></i> View
                </a>


                <a href='/frame/books?favourite=<?= $book->id ?>' class="btn btn-warning mb-2"><i class="fa fa-heart"></i> Favourite</a>

                <?php

                if (Users::current_user()->acl == 'Admin') {
                ?>
                    <a href="<?= PROOT ?>books/edit/<?= $book->id ?>" class="btn btn-primary mb-2">
                        <i class="fa fa-edit"></i> Edit
                    </a>dmin/users
                    <a href="<?= PROOT ?>books/delete/<?= $book->id ?>" class="btn btn-danger mb-2" onclick="if(!confirm('Are you shure ?')){return false;}">
                        <i class="fa fa-remove"></i> Delete
                    </a>

                <?php
                }
                ?>



            </div>
        <?php endforeach ?>
    </div>
</div>

<?php $this->end(); ?>



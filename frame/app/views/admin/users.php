<?php

use App\Models\Admin;
use Core\H;

$this->set_site_title('Users') ?>

<?php $this->start('body') ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class=" text-center">Users</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <?php $this->partial('admin', 'table_header') ?>
                            </thead>
                            <tbody>
                                <?php foreach ($this->users as $key => $user) {
                                ?>
                                    <tr>
                                        <td><a href="<?= ADMIN_USER . $user->id ?>"><?= $user->fname ?></a></td>
                                        <td><?= $user->lname ?></td>
                                        <td><?= $user->username ?></td>
                                        <td><?= $user->acl ?></td>
                                        <td><?= H::convert_number($user->deleted) ?></td>
                                        <td><a href="<?= ADMIN_EDIT . $user->id ?>"> <button class="btn btn-block btn-primary">Edit</button> </a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php $this->partial('admin', 'table_header') ?>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
    });
</script>

<?php $this->end() ?>
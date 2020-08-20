<?php

use Core\Router;
use Core\H;
use App\Models\Users;

$menu = Router::getMenu('menu_acl');
$current_page = H::current_page();

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo PROOT  ?>"><?php echo MENU_BRAND ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            foreach ($menu as $key => $val) {
                $active = '';
                if (is_array($val)) {
                    $active = ($val  == $current_page) ? 'active' : '';
            ?>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle <?= $active ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $key  ?>
                        </a>
                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <?php

                            foreach ($val as $k => $v) {
                                $active = ($v == $current_page) ? 'active' : '';

                                if ($k == 'separator') {
                            ?>

                                    <div class="dropdown-divider"></div>

                                <?php
                                } else {
                                    $active = ($v == $current_page) ? 'active' : '';
                                ?>

                                    <a class="dropdown-item <?= $active ?>" href="<?php echo $v ?>"><?php echo $k ?></a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </li>

                <?php
                } else {
                    $active = ($val == $current_page) ? 'active' : '';

                ?>
                    <li class="nav-item <?= $active ?>">
                        <a class="nav-link  " href="<?php echo $val ?>"><?php echo $key ?></a>
                    </li>
            <?php
                }
            }
            ?>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <div class="mr-1"> <?= (Users::current_user()) ? ' Hello: <a href="admin/edit/' . Users::current_user()->id . '">' . Users::current_user()->fname . '</a>' : ''; ?> </div>
            <div> <?= (Users::current_user()) ? ' ' . Users::current_user()->acl : '' ?></div>
        </div>
    </div>
</nav>
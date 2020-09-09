<?php

use Core\Session;
use Core\H;
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->site_title(); ?></title>

    <?php
    $link = $_SERVER['REQUEST_URI'];
    $find = "admin";
    if (strpos($link, $find)) {
    ?>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo PROOT ?>css/bootstrap_3.min.css" crossorigin="anonymous">
        <!-- custom css -->
        <link rel="stylesheet" href="<?= PROOT ?>css/AdminLTE.min.css">
        <!-- skins -->
        <link rel="stylesheet" href="<?= PROOT ?>css/skins/_all-skins.min.css">

        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />


    <?php

    } else {
    ?>
        <link rel="stylesheet" href="<?php echo PROOT ?>css/bootstrap.min.css" crossorigin="anonymous">
    <?php
    }
    ?>






    <!-- custom style -->
    <link rel="stylesheet" href="<?php echo PROOT ?>css/custom.css" crossorigin="anonymous">

    <!-- load scripts -->
    <!-- fontawesome css -->
    <link rel="stylesheet" href="<?= PROOT ?>/css/font-awesome.min.css">
    <script src="<?php echo PROOT ?>js/jquery-3.5.1.min.js"></script>

    <!-- custom scripts -->
    <script src="<?php echo PROOT ?>js/custom.js"></script>
    <!-- tinymce  -->
    <script src="<?= PROOT ?>/js/tinymce.min.js"></script>
    <!-- tinymce config -->
    <script src="<?= PROOT ?>/js/tinymce_settings.js"></script>

    <?php

    echo $this->content('head');
    ?>

</head>

<body onload="getLocation()">

    <?php
    (!strpos($link, $find)) ? include 'main_menu.php' : include 'admin_menu.php';
    ?>

    <div class="" style="min-height:cal(100% - 125px)">
        <?= Session::display_msg() ?>
        <?php echo $this->content('body'); ?>

    </div>

    
    <!-- load scripts -->
    <!-- bootstrap -->
    <?php

    if (strpos($link, $find)) {
    ?>
        <script>
            // $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="<?php echo PROOT ?>js/bootstrap_3.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

        <!-- <script src="<?= PROOT ?>plugins/morris/morris.min.js" type="text/javascript"></script> -->
        <!-- Sparkline -->
        <!-- <script src="<?= PROOT ?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script> -->
        <!-- jvectormap -->
        <!-- <script src="<?= PROOT ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?= PROOT ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script> -->
        <!-- jQuery Knob Chart -->
        <!-- <script src="<?= PROOT ?>plugins/knob/jquery.knob.js" type="text/javascript"></script> -->
        <!-- daterangepicker -->
        <!-- <script src="<?= PROOT ?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script> -->
        <!-- datepicker -->
        <!-- <script src="<?= PROOT ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script> -->
        <!-- Bootstrap WYSIHTML5 -->
        <!-- <script src="<?= PROOT ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> -->
        <!-- iCheck -->
        <!-- <script src="<?= PROOT ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script> -->
        <!-- Slimscroll -->
        <!-- <script src="<?= PROOT ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script> -->
        <!-- FastClick -->
        <!-- <script src='<?= PROOT ?>plugins/fastclick/fastclick.min.js'></script> -->
        <!-- AdminLTE App -->
        <script src="<?= PROOT ?>js/app.min.js" type="text/javascript"></script>

        <!-- <script src="<?= PROOT ?>js/dashboard.js" type="text/javascript"></script> -->

        <!-- data tables design -->
        <script src="<?= PROOT ?>/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?= PROOT ?>/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

    <?php

    } else {
    ?>
        <script src="<?php echo PROOT ?>js/bootstrap.min.js"></script>
    <?php
    }
    ?>
</body>



</html>